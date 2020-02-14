<?php
namespace App\Crud;

use App\Crud\Inheritance\Inheritance;

/**
 * Trait InheritanceAwareTrait
 */
trait InheritanceAwareTrait
{
    /**
     * @var Inheritance
     */
    private $resolver;

    /**
     * @param Inheritance $resolver
     */
    public function setInheritanceResolver(Inheritance $resolver)
    {
        $this->resolver = $resolver;
    }

    /**
     * @return Inheritance
     */
    public function getInheritanceResolver()
    {
        return $this->resolver;
    }
}
