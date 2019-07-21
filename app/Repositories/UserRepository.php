<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return User::class;
    }

    public function __construct(User $user)
    {
        parent::__construct($user);
    }
}
