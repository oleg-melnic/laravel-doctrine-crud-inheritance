<?php

namespace App\Crud;

interface DeleteInterface
{
    /**
     * Удаление сущности, поддерживает массив id
     *
     * @param int|array $identity ключ может быть составным
     * @throw \App\Crud\Exception\DeletionFailed
     *
     * @return bool
     */
    public function delete($identity);
}
