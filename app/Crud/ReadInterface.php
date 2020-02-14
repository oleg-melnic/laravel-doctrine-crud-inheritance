<?php

namespace App\Crud;

/**
 * Interface ReadInterface
 *
 * @package App\Crud
 */
interface ReadInterface
{
    /**
     * Поиск сущности по identity
     *
     * @param int|array $identity ключ может быть составным
     *
     * @throws \App\Crud\Exception\EntityNotFound
     *
     * @return object
     */
    public function find($identity);

    /**
     * Есть ли сущность
     *
     * @param int|array $identity ключ может быть составным
     *
     * @return bool
     */
    public function has($identity);

    /**
     * Выбрать все сущности
     *
     * @return array
     */
    public function findAll();

    /**
     * Получение сущности в виде массива
     *
     * @param $identity
     * @return array
     */
    public function extract($identity);
}
