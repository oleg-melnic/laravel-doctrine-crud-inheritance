<?php

namespace App\Crud\Inheritance;

use App\Crud\Exception\EntityNotFound;
use LaravelDoctrine\ORM\Facades\EntityManager;

/**
 * Class ResolverAbstract
 */
abstract class ResolverAbstract implements ResolverInterface
{
    /**
     * @var string
     */
    private $baseEntityName;

    /**
     * Имя ресурса, для разграничения доступа
     * @var string
     */
    private $resourceName;

    /**
     * @param $resourceName
     */
    public function __construct($resourceName)
    {
        $this->setResourceId($resourceName);
    }

    /**
     * @param int $identity
     * @return object
     * @throws EntityNotFound
     */
    public function find($identity)
    {
        if (is_null($entity = $this->getRepository()->find($identity))) {
            throw new EntityNotFound(
                sprintf('Сущности %s с таким id не существует %s', $this->getBaseEntityName(), $identity)
            );
        } else {
            return $entity;
        }
    }

    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    public function getRepository()
    {
        return EntityManager::getRepository($this->getBaseEntityName());
    }

    /**
     * @return string
     */
    public function getBaseEntityName()
    {
        return $this->baseEntityName;
    }

    /**
     * @param string $baseEntityName
     */
    public function setBaseEntityName($baseEntityName)
    {
        $this->baseEntityName = $baseEntityName;
    }

    /**
     * @param int $identity
     * @return bool
     */
    public function has($identity)
    {
        if (is_null($this->getRepository()->find($identity))) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return $this->getRepository()->findAll();
    }

    /**
     * Получить имя ресурса, для разделения прав доступа
     *
     * @return string
     */
    public function getResourceId()
    {
        return $this->resourceName;
    }

    /**
     * @param string $resourceName
     */
    private function setResourceId($resourceName)
    {
        $this->resourceName = $resourceName;
    }
}
