<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'login-log',
            'user-force-logout',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'role-restore',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'user-restore',
            'branch-list',
            'branch-create',
            'branch-edit',
            'branch-delete',
            'branch-restore',
            'branch-switch',
            'project-list',
            'project-create',
            'project-edit',
            'project-delete',
            'project-restore',
            'director-list',
            'director-create',
            'director-edit',
            'director-delete',
            'director-restore',
            'project-director-list',
            'project-director-create',
            'project-director-edit',
            'project-director-delete',
            'project-director-restore',
            'head-list',
            'head-create',
            'head-edit',
            'head-delete',
            'head-restore',
            'income-expense-list',
            'income-expense-create',
            'income-expense-edit',
            'income-expense-delete',
            'income-expense-restore',
            'bank-transfer-list',
            'bank-transfer-create',
            'bank-transfer-edit',
            'bank-transfer-delete',
            'bank-transfer-restore',
            'manufacturer-supplier-list',
            'manufacturer-supplier-create',
            'manufacturer-supplier-edit',
            'manufacturer-supplier-delete',
            'manufacturer-supplier-restore',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
            'product-restore',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }
    }
}
