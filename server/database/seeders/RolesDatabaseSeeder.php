<?php

namespace Database\Seeders;

use App\Enums\Role as EnumsRole;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert(array_map(function ($role) {
            return [
                'name' => $role,
                'guard_name' => 'web',
            ];
        }, EnumsRole::cases()));
    }
}
