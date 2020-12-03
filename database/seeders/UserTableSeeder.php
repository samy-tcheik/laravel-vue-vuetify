<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Role::truncate();
        Permission::truncate();
        
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'created_at' => Carbon::now()->toDateString()
        ]);

        $manager = User::create([
            'name' => 'manager',
            'email' => 'manager@manager.com',
            'password' => Hash::make('manager'),
            'created_at' => Carbon::now()->toDateString()
        ]);

        $visitor = User::create([
            'name' => 'visitor',
            'email' => 'visitor@visitor.com',
            'password' => Hash::make('visitor'),
            'created_at' => Carbon::now()->toDateString()
        ]);

        //permission

        $manage_managers = Permission::create(['name' => 'manage managers']);
        $manage_users = Permission::create(['name' => 'manage users']);
        $manage_employees = Permission::create(['name' => 'manage employees']);
        $access_backend = Permission::create(['name' => 'access backend']);

        //roles

        $admin_role = Role::create(['name' => 'admin']);
        
        $manager_role = Role::create(['name' => 'manager']);
        
        $visitor_role = Role::create(['name' => 'visitor']);


        $admin_role->givePermissionTo($manage_managers, $manage_users, $manage_employees, $access_backend);
        $manager_role->givePermissionTo($manage_employees,$access_backend);
        $visitor_role->givePermissionTo($access_backend);
        
        $admin->assignRole('admin');
        $manager->assignRole('manager');
        $visitor->assignRole('visitor');
    }
}
