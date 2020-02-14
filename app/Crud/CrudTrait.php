<?php

namespace App\Crud;

use App\Crud\Helper;

/**
 * Trait CrudTrait
 */
trait CrudTrait
{
    use Helper\CreateTrait;
    use Helper\DeleteTrait;
    use Helper\UpdateTrait;
    use Helper\ReadTrait;
}
