<?php
namespace App\Crud;

use App\Crud\Inheritance\NoInheritance;

/**
 * Trait NoInheritanceAwareTrait
 */
trait NoInheritanceAwareTrait
{
    /**
     * @var NoInheritance
     */
    private $resolver;

    /**
     * @param NoInheritance $resolver
     */
    public function setInheritanceResolver(NoInheritance $resolver)
    {
        $this->resolver = $resolver;
    }

    /**
     * @return NoInheritance
     */
    public function getInheritanceResolver()
    {
        return $this->resolver;
    }
}
