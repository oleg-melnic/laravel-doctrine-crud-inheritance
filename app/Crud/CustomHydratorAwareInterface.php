<?php
namespace App\Crud;

use Laminas\Hydrator\HydratorAwareInterface;

/**
 * Interface HydratorCustomAwareInterface
 */
interface CustomHydratorAwareInterface extends HydratorAwareInterface
{
    /**
     * Получить имя hydrator
     *
     * @return string
     */
    public function getHydratorName();
}
