<?php

namespace App\Services;

use App\Repositories\UserRolesRepository;
use App\Services\UsersService;
use App\Models\Users\UserRole;
use App\Models\User;

class UserRolesService extends UserRolesRepository
{
    public function __construct(
        public UsersService $usersService
    )
    {
        parent::__construct(new UserRole(), ['users']);
    }

    public function assignRoleToUser($data)
    {
        return $this->usersService->updateById($data->user_id, [
            'user_role_id'  => $data->user_role_id
        ]);
    }
}
