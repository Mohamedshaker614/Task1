<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = Admin::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456789'),
            'role_name' => 'Owner'
        ]);
        $role = \Spatie\Permission\Models\Role::create(['name' => 'Owner', 'guard_name' => 'admins']);
        $permissions = DB::table('permissions')->pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);


        $user1 = Admin::create([
            'name' => 'Email 1',
            'email' => 'email1@admin.com',
            'password' => Hash::make('123456789'),
            'role_name' => 'Admin1'
        ]);
        $role1 = \Spatie\Permission\Models\Role::create(['name' => 'Admin1', 'guard_name' => 'admins']);
        $permissions1 = DB::table('permissions')
            ->where('name', 'Categories')
            ->orWhere('name', 'Category Add')
            ->pluck('id', 'id')->all();
        $role1->sync($permissions1);
        $user1->assignRole([$role1->id]);


        $user2 = Admin::create([
            'name' => 'Email 2',
            'email' => 'email2@admin.com',
            'password' => Hash::make('123456789'),
            'role_name' => 'Admin2'
        ]);
        $role2 = \Spatie\Permission\Models\Role::create(['name' => 'Admin2', 'guard_name' => 'admins']);
        $permissions2 = DB::table('permissions')
            ->where('name', 'Products')
            ->orWhere('name', 'Product Add')
            ->pluck('id', 'id')->all();
        $role2->syncPermissions($permissions2);
        $user2->assignRole([$role2->id]);


        User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => Hash::make('123456789'),
        ]);
    }
}
