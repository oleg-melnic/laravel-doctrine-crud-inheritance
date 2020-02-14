<?php

namespace App\Crud\Helper;

use App\Crud\Exception\ValidationException;
use App\Crud\Inheritance\ResolverAbstract as InheritanceResolverAbstract;

/**
 * @method InheritanceResolverAbstract getInheritanceResolver()
 */
trait UpdateTrait
{
    /**
     * @param       $identity
     * @param array $data
     *
     * @throws ValidationException
     *
     * @return object
     */
    public function update($identity, array $data, array $context = [], $permission = __FUNCTION__)
    {
        return $this->getInheritanceResolver()->update($identity, $data, $context, $permission);
    }
}
