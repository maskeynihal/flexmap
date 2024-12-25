<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FilamentAdminDashboardAccessDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            PermissionsDatabaseSeeder::class,
            RolesDatabaseSeeder::class,
            AdminUserRolePermissionDatabaseSeeder::class,
        ]);
    }
}
