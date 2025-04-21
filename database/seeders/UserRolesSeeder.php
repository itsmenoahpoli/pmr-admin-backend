<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Users\UserRole;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['admin', 'physical-therapist', 'staff'];

        foreach ($roles as $role) {
            UserRole::query()->create([
                'name' => $role,
            ]);
        }
    }
}
