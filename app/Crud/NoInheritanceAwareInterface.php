<?php
namespace App\Crud;

use App\Crud\Inheritance\NoInheritance;

/**
 * Interface NoInheritanceAwareInterface
 */
interface NoInheritanceAwareInterface extends EntityFactoryInterface
{
    /**
     * Получить имя сущности
     *
     * @return string
     */
    public function getBaseEntityName();

    /**
     * @param NoInheritance $resolver
     *
     * @return void
     */
    public function setInheritanceResolver(NoInheritance $resolver);
}
