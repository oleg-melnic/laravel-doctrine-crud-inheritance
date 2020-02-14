<?php
namespace App\Crud\Inheritance;

use App\Crud\EntityFactoryInterface;
use App\Crud\Exception;
use App\Crud\Translatable\StrategyInterface;
use Laminas\Hydrator\HydratorAwareInterface;
use Laminas\Hydrator\HydratorAwareTrait;
use LaravelDoctrine\ORM\Facades\EntityManager;

/**
 * Class resolver случай, когда не используется inheritance
 */
class NoInheritance extends ResolverAbstract implements HydratorAwareInterface
{
    use HydratorAwareTrait;

    /**
     * Языковая стратегия
     *
     * @var StrategyInterface
     */
    private $languageStrategy;

    /**
     * Фабрика создания сущности
     *
     * @var EntityFactoryInterface
     */
    private $entityFactory;

    /**
     * Создать и заполнить Entity из входящих данных
     *
     * @param array  $data
     * @param object $entity
     *
     * @param array  $context
     * @return object
     */
    protected function buildEntity(array $data, $entity = null, array $context = [])
    {
        if (isset($data['type'])) unset($data['type']);
        if (is_null($entity)) {
            $entity = $this->getEntityFactory()->createEmptyEntity($data);
        }
        $entity = $this->getLanguageStrategy()->hydrate($entity, $data, $this->getHydrator());
        return $entity;
    }

    /**
     * Удаление сущности по identity
     *
     * @param int|array $identity
     * @param string    $actionName
     *
     * @return bool
     */
    public function delete($identity, $actionName = __FUNCTION__)
    {
        if (!is_array($identity)) {
            $identity = [$identity];
        } else {
            trigger_error('Пакетное удаление запрещено.');
        }

        foreach ($identity as $itemIdentity) {
            try {
                $entity = $this->find($itemIdentity);

                EntityManager::remove($entity);
                EntityManager::flush();
            } catch (\Exception $e) {
                throw new Exception\DeletionFailed(
                    sprintf('Объект с id "%s" не был удален', $itemIdentity),
                    $e->getCode(),
                    $e
                );
            }
        }

        return true;
    }

    /**
     * Обновить сущность
     *
     * @param array|int $identity
     * @param array     $data
     * @param array     $context
     * @param string    $actionName
     *
     * @return object
     */
    public function update($identity, array $data, array $context = [], $actionName = __FUNCTION__)
    {
        $entity = $this->find($identity);

        $fullData = $this->getFullData($entity, $data);
        $entity   = $this->buildEntity($fullData, $entity, $context);
        $this->save();

        return $entity;
    }

    /**
     * Получить смереженные данные сущности и $data
     *
     * @param object $entity
     * @param array  $data
     *
     * @return array
     */
    public function getFullData($entity, array $data)
    {
        return $this->getLanguageStrategy()->extractEntity($data, $entity, $this->getHydrator());
    }

    /**
     * Получить языковую стратегию
     *
     * @return StrategyInterface
     */
    public function getLanguageStrategy()
    {
        return $this->languageStrategy;
    }

    /**
     * Установить языковую стратегию
     *
     * @param StrategyInterface $strategy
     */
    public function setLanguageStrategy(StrategyInterface $strategy)
    {
        $this->languageStrategy = $strategy;
    }

    /**
     * Создание сущности и созранение
     *
     * @param array  $data
     * @param bool   $flush
     * @param array  $context
     *
     * @param string $actionName
     *
     * @return object
     */
    public function create(array $data, $flush = true, array $context = [], $actionName = __FUNCTION__)
    {
        $entity = $this->buildEntity($data, null, $context);
        $this->save($entity, $flush);

        return $entity;
    }

    /**
     * Получить фабрику создания сущности
     *
     * @return EntityFactoryInterface
     */
    public function getEntityFactory()
    {
        return $this->entityFactory;
    }

    /**
     * Установить фабрику создания сущности
     *
     * @param EntityFactoryInterface $entityFactory
     */
    public function setEntityFactory(EntityFactoryInterface $entityFactory)
    {
        $this->entityFactory = $entityFactory;
    }

    /**
     * Сохранить сущность
     *
     * @param object $entity
     * @param bool   $flush
     */
    protected function save($entity = null, $flush = true)
    {
        if (!is_null($entity)) {
            EntityManager::persist($entity);
        }

        if ($flush) {
            EntityManager::flush();
        }
    }

    /**
     * Получение сущности в виде массива
     *
     * @param $identity
     * @return array
     */
    public function extract($identity)
    {
        $entity = $this->find($identity);
        return $this->getLanguageStrategy()->extractEntity([], $entity, $this->getHydrator());
    }
}
