<?php

namespace App\Crud;

/**
 * Interface UpdateInterface
 *
 * @package App\Crud
 */
interface UpdateInterface
{
    /**
     * Обновление сущности
     *
     * @param int|array $identity ключ может быть составным
     * @param array $data
     * @param array $context
     * @param string $permission
     * @throws \App\Crud\Exception\ValidationException
     *
     * @return object
     */
    public function update($identity, array $data, array $context = [], $permission = __FUNCTION__);
}
