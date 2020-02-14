<?php

namespace App\Crud\Helper;

use App\Crud\Exception\EntityNotFound;
use App\Crud\Inheritance\ResolverAbstract;

/**
 * @method ResolverAbstract getInheritanceResolver()
 */
trait ReadTrait
{
    /**
     * @param int $identity
     * @return object
     * @throws EntityNotFound
     */
    public function find($identity)
    {
        return $this->getInheritanceResolver()->find($identity);
    }

    /**
     * @param int $identity
     *
     * @return bool
     */
    public function has($identity)
    {
        return $this->getInheritanceResolver()->has($identity);
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return $this->getInheritanceResolver()->findAll();
    }

    /**
     * Получение ввиде массива данных об объекте
     *
     * @param $identity
     * @return array
     */
    public function extract($identity)
    {
        return $this->getInheritanceResolver()->extract($identity);
    }
}
