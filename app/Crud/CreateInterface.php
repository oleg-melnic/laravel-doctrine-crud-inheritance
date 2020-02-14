<?php

namespace App\Crud;

interface CreateInterface
{
    /**
     * Создание сущности
     *
     * @param array $data
     * @param bool $flush
     * @param array $context - контекст для валидаторов
     * @param string $permission - от какого acl permission выполняется действие
     * @throws \App\Crud\Exception\ValidationException
     *
     * @return object
     */
    public function create(array $data, $flush = true, array $context = [], $permission = __FUNCTION__);
}
