<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Project;
use App\Models\User;
use App\Models\UserBranch;
use App\Models\UserProject;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $permissions = [
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
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }

        $user = User::factory()->create([
            'name' => 'Vijoy Sasidharan',
            'email' => 'mail@cybernetics.me',
            'password' => Hash::make('stupid'),
        ]);

        $branch = Branch::create([
            'name' => 'Devi Eye Hospital - Sasthamkotta',
            'code' => 'TVM',
            'mobile' => '0123456789',
            'contact_number' => '0123456789',
            'address' => 'Trivandrum',
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        Role::create(['name' => 'Partner']);
        $role = Role::create(['name' => 'Administrator']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
        UserBranch::create([
            'user_id' => $user->id,
            'branch_id' => $branch->id
        ]);
    }
}
