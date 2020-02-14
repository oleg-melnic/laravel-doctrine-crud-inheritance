<?php

namespace App\Entities\User;

use Doctrine\ORM\Mapping as ORM;

/**
 * Admin
 * @ORM\Entity
 */
class Admin extends UserAbstract
{
    /**
     * Get a list of role names
     *
     * @return array
     */
    protected function getRoleNames()
    {
        return ['admin'];
    }
}
