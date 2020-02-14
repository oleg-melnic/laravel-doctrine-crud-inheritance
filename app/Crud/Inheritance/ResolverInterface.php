<?php
namespace App\Crud\Inheritance;

use App\Crud\CrudInterface;

/**
 * Interface ResolverInterface
 */
interface ResolverInterface extends CrudInterface
{
    /**
     * @return string
     */
    public function getBaseEntityName();

    /**
     * @param string $entityName
     *
     * @return void
     */
    public function setBaseEntityName($entityName);

    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    public function getRepository();
}
