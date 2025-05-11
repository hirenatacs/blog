<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::firstOrCreate([
            'name' => 'Super Admin',
            'guard_name' => 'admin'
        ]);
        $admin = Role::firstOrCreate([
            'name' => 'Admin',
            'guard_name' => 'admin'
        ]);
 
        //$permissions = Permission::all();
        //$superAdmin->syncPermissions($permissions);


        $permissions = ['manage roles', 'manage permissions', 'manage admins', 'manage users'];
        foreach ($permissions as $permission) {
            $perm = Permission::firstOrCreate(
                [
                    'name' => $permission
                ],
                [
                    'name' => $permission,
                    'guard_name' => 'admin'
                ]
            );
            $superAdmin->givePermissionTo($perm);
            if($permission === 'manage users'){
                $admin->givePermissionTo($perm);
            }
        }
    }
}
