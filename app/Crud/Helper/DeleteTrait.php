<?php

namespace App\Crud\Helper;

use App\Crud\Exception\DeletionFailed;
use App\Crud\Inheritance\ResolverAbstract;

/**
 * @method ResolverAbstract getInheritanceResolver()
 */
trait DeleteTrait
{
    /**
     * @param int $identity
     * @throws DeletionFailed
     * @return bool
     */
    public function delete($identity)
    {
        return $this->getInheritanceResolver()->delete($identity);
    }
}
