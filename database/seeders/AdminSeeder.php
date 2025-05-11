<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Admin::firstOrCreate([
            'name' => 'Super Admin',
            'email' => 'super.admin@blog.com',
            'password' => bcrypt('admin'),
        ]);

        $admin = Admin::firstOrCreate([
            'name' => 'Admin',
            'email' => 'admin@blog.com',
            'password' => bcrypt('admin'),
        ]);

        $superAdminRole = Role::firstOrCreate([
            'name' => 'Super Admin',
            'guard_name' => 'admin'
        ]);
        $adminRole = Role::firstOrCreate([
            'name' => 'Admin',
            'guard_name' => 'admin'
        ]);
        
        $superAdmin->syncRoles([$superAdminRole]);
        $admin->syncRoles([$adminRole]);

    }
}
