<?php
namespace App\Crud\Translatable;

use Laminas\Hydrator\HydratorInterface;

/**
 * Interface StrategyInterface
 */
interface StrategyInterface
{
    /**
     * @param array $data
     * @param object $entity
     * @param HydratorInterface $hydrator
     *
     * @return array
     */
    public function extractEntity(array $data, $entity, HydratorInterface $hydrator);

    /**
     * @param object $entity
     * @param array $data
     * @param HydratorInterface $hydrator
     *
     * @return object $entity
     */
    public function hydrate($entity, array $data, HydratorInterface $hydrator);
}
