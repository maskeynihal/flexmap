<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $PERMISSIONS = [
            'admin.dashboard.access' => 'admin.dashboard.access',
        ];

        Permission::insert(array_map(function ($permission) {
            return [
                'name' => $permission,
                'guard_name' => 'web',
            ];
        }, $PERMISSIONS));
    }
}
