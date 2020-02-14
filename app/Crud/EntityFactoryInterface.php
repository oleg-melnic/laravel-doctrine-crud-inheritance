<?php
namespace App\Crud;

/**
 * Interface EntityFactoryInterface
 */
interface EntityFactoryInterface
{
    /**
     * @param array $data
     * @return object
     */
    public function createEmptyEntity(array $data);
}
