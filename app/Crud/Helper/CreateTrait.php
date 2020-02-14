<?php
namespace App\Crud\Helper;

use App\Crud\Inheritance\ResolverAbstract;

/**
 * @method ResolverAbstract getInheritanceResolver()
 */
trait CreateTrait
{
    /**
     * @param array  $data
     *
     * @param bool   $flush
     * @param array  $context
     * @param string $permission
     *
     * @return object
     */
    public function create(array $data, $flush = true, array $context = [], $permission = __FUNCTION__)
    {
        $entity = $this->getInheritanceResolver()->create($data, $flush, $context, $permission);

        return $entity;
    }
}
