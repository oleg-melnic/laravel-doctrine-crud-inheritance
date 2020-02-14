<?php
namespace App\Crud;

use App\Crud\Inheritance\Inheritance;

/**
 * Interface InheritanceAwareInterface
 */
interface InheritanceAwareInterface
{
    /**
     * Получить название поля являющееся разделителем inheritance
     *
     * @return string
     */
    public function getDiscriminatorName();

    /**
     * Получить список поддерживаемых серверов.
     *
     * формат: [
     *   '<имя из сущности>' => '<имя сервиса>'
     * ]
     *
     * @return array
     */
    public function getServicesNames();

    /**
     * @param Inheritance $resolver
     *
     * @return void
     */
    public function setInheritanceResolver(Inheritance $resolver);

    /**
     * Получить имя сущности
     *
     * @return string
     */
    public function getBaseEntityName();
}
