<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Contracts\Permission;

class PermissionTableSeeder extends Seeder
{

    public function run()
    {
        $permissions = [
            ['name' => 'Categories', 'ar_name' => 'الاقسام', 'guard_name' => 'admins'],
            ['name' => 'Category Add', 'ar_name' => 'أضافة قسم','guard_name' => 'admins'],
            ['name' => 'Category Edit', 'ar_name' => 'تعديل قسم','guard_name' => 'admins'],
            ['name' => 'Category Delete', 'ar_name' => 'حذف قسم','guard_name' => 'admins'],

            ['name' => 'Products', 'ar_name' => 'المنتجات', 'guard_name' => 'admins'],
            ['name' => 'Product Add', 'ar_name' => 'أضافة منتج','guard_name' => 'admins'],
            ['name' => 'Product Edit', 'ar_name' => 'تعديل منتج','guard_name' => 'admins'],
            ['name' => 'Product Delete', 'ar_name' => 'حذف منتج','guard_name' => 'admins'],
        ];
        foreach ($permissions as $permission) {
            DB::table('permissions')->insert($permission);
        }
    }
}
