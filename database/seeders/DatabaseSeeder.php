<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Extra;
use App\Models\Month;
use App\Models\Project;
use App\Models\User;
use App\Models\UserBranch;
use App\Models\UserDevice;
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
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }

        $user = User::factory()->create([
            'name' => 'Vijoy Sasidharan',
            'email' => 'mail@cybernetics.me',
            'password' => Hash::make('stupid'),
        ]);

        $months = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December',
        ];

        $btypes = [
            'Hospital',
            'Store',
            'DRX Lab',
            'Other Lab',
            'Other',
        ];

        $pmodes = [
            'Cash',
            'Card',
            'Cheque',
            'Upi',
            'Bank Transfer',
            'Other',
        ];

        $devices = [
            'Computer',
            'Android',
            'iOS',
            'Tablet',
            'Other',
        ];

        $contribution = [
            'Onetime',
            'Installment'
        ];

        foreach ($months as $month) {
            Extra::insert(['name' => $month, 'category' => 'month']);
        }

        foreach ($btypes as $btype) {
            Extra::insert(['name' => $btype, 'category' => 'branch_type']);
        }

        foreach ($devices as $device) {
            Extra::insert(['name' => $device, 'category' => 'device']);
        }

        foreach ($pmodes as $pmode) {
            Extra::insert(['name' => $pmode, 'category' => 'pmode']);
        }

        foreach ($contribution as $c) {
            Extra::insert(['name' => $c, 'category' => 'contribution']);
        }

        $branch = Branch::create([
            'name' => 'Devi Eye Hospital - Sasthamkotta',
            'code' => 'TVM',
            'mobile' => '0123456789',
            'contact_number' => '0123456789',
            'address' => 'Trivandrum',
            'is_primary' => true,
            'type' => 13,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        $role = Role::create(['name' => 'Administrator']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
        UserBranch::create([
            'user_id' => $user->id,
            'branch_id' => $branch->id
        ]);
        UserDevice::insert([
            'user_id' => $user->id,
            'device_id' => 18,
        ]);
    }
}
