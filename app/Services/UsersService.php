<?php

namespace App\Services;

use App\Repositories\UsersRepository;
use App\Models\User;

class UsersService extends UsersRepository
{
    public function __construct()
    {
        parent::__construct(new User(), ['user_role']);
    }
}
