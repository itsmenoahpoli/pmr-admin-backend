<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Users\UserRole;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = UserRole::query()->get();

        foreach($roles as $role)
        {
            User::query()->create([
                'uid'           => strtoupper(Str::random(6)).strval(now()->timestamp),
                'name'          => $role->name.' User',
                'email'         => $role->name.'@pmrfacility.com',
                'password'      => bcrypt('CT0bFG3MUW'),
                'is_enabled'    => true,
                'user_role_id'  => $role->id
            ]);
        }
    }
}
