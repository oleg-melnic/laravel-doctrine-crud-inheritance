<?php
namespace App\Crud\Inheritance;

use App\Crud\CrudInterface;
use App\Crud\Inheritance\Exception\DomainLogic;
use App\Crud\Inheritance\Exception\InvalidArgument;
use LaravelDoctrine\ORM\Facades\EntityManager;

/**
 * Class Inheritance
 */
class Inheritance extends ResolverAbstract
{
    /**
     * Registered strategies for inheritance
     *
     * @var CrudInterface[]
     */
    private $strategies = [];

    /**
     * Discriminator delimiter name for inheritance
     *
     * @var string
     */
    private $discriminatorName;

    /**
     * Регистрация сервисов для каждого типа сущностей
     *
     * @param string $name имя стратегии
     * @param CrudInterface $strategy сервис обработки конкретных сущностей
     */
    public function registerStrategy($name, CrudInterface $strategy)
    {
        $this->strategies[$name] = $strategy;
    }

    /**
     * Получаем нужную стратегию
     *
     * @param string $type
     *
     * @return CrudInterface
     */
    public function getStrategy($type)
    {
        if (!isset($this->strategies[$type])) {
            throw new DomainLogic(
                sprintf(
                    'Неизвестный тип стратегии. Получили: %s. Зарегистрированые: %s',
                    $type,
                    print_r(array_keys($this->strategies), true)
                )
            );
        }

        return $this->strategies[$type];
    }

    /**
     * Проверяем на наличие дискриминатора в данных
     *
     * @param $data
     */
    protected function validateType($data)
    {
        if (!isset($data[$this->getDiscriminatorName()])) {
            throw new InvalidArgument(
                sprintf(
                    'В данных не содержится discriminator: "%s". Получили: %s',
                    $this->getDiscriminatorName(),
                    print_r(array_keys($data), true)
                )
            );
        }
    }

    /**
     * Получить имя поля разграничивающее inheritance
     *
     * @return string
     */
    public function getDiscriminatorName()
    {
        return $this->discriminatorName;
    }

    /**
     * Установить имя поля разгграничивающее inheritance
     *
     * @param string $discriminatorName
     */
    public function setDiscriminatorName($discriminatorName)
    {
        $this->discriminatorName = $discriminatorName;
    }

    /**
     * @param $identity
     *
     * @return CrudInterface
     */
    public function getStrategyByIdentity($identity)
    {
        $entity = $this->find($identity);
        /** @var \Doctrine\ORM\Mapping\ClassMetadata $metadata */
        $metadata = EntityManager::getClassMetadata(get_class($entity));
        return $this->getStrategy($metadata->discriminatorValue);
    }

    /**
     * Удаление сущности
     *
     * @param int $identity
     * @param string $actionName
     *
     * @return bool
     * @throw \App\Crud\Exception\DeletionFailed
     *
     */
    public function delete($identity, $actionName = __FUNCTION__)
    {
        if (!is_array($identity)) {
            $identity = [$identity];
        }

        foreach ($identity as $itemIdentity) {
            $this->getStrategyByIdentity($itemIdentity)->delete($itemIdentity);
        }

        return true;
    }

    /**
     * @param array|int $identity
     * @param array $data
     * @param array $context
     * @param string $actionName
     *
     * @return object
     */
    public function update($identity, array $data, array $context = [], $actionName = __FUNCTION__)
    {
        return $this->getStrategyByIdentity($identity)->update($identity, $data, $context);
    }

    /**
     * @param array $data
     * @param bool $flush
     * @param array $context
     * @param string $actionName
     *
     * @return object
     */
    public function create(array $data, $flush = true, array $context = [], $actionName = __FUNCTION__)
    {
        $this->validateType($data);
        $strategy = $this->getStrategy($data[$this->getDiscriminatorName()]);

        return $strategy->create($data, $flush, $context);
    }

    /**
     * Получение сущности в виде массива
     *
     * @param $identity
     *
     * @return array
     */
    public function extract($identity)
    {
        return $this->getStrategyByIdentity($identity)->extract($identity);
    }
}
