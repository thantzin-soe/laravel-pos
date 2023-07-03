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
            ['name' => 'pos.menu', 'group_name' => 'pos'],

            ['name' => 'employee.menu', 'group_name' => 'emploee'],
            ['name' => 'employee.all', 'group_name' => 'emploee'],
            ['name' => 'employee.add', 'group_name' => 'emploee'],
            ['name' => 'employee.edit', 'group_name' => 'emploee'],
            ['name' => 'employee.delete', 'group_name' => 'emploee'],

            ['name' => 'customer.menu', 'group_name' => 'customer'],
            ['name' => 'customer.all', 'group_name' => 'customer'],
            ['name' => 'customer.add', 'group_name' => 'customer'],
            ['name' => 'customer.edit', 'group_name' => 'customer'],
            ['name' => 'customer.delete', 'group_name' => 'customer'],

            ['name' => 'supplier.menu', 'group_name' => 'supplier'],
            ['name' => 'supplier.all', 'group_name' => 'supplier'],
            ['name' => 'supplier.add', 'group_name' => 'supplier'],
            ['name' => 'supplier.edit', 'group_name' => 'supplier'],
            ['name' => 'supplier.delete', 'group_name' => 'supplier'],


            ['name' => 'salary.menu', 'group_name' => 'salary'],
            ['name' => 'salary.add', 'group_name' => 'salary'],
            ['name' => 'salary.all', 'group_name' => 'salary'],
            ['name' => 'salary.pay', 'group_name' => 'salary'],
            ['name' => 'salary.paid', 'group_name' => 'salary'],


            ['name' => 'attendance.menu', 'group_name' => 'attendance'],
            ['name' => 'category.menu', 'group_name' => 'category'],
            ['name' => 'product.menu', 'group_name' => 'product'],
            ['name' => 'expense.menu', 'group_name' => 'expense'],
            ['name' => 'orders.menu', 'group_name' => 'orders'],
            ['name' => 'stock.menu', 'group_name' => 'stock'],
            ['name' => 'roles.menu', 'group_name' => 'roles'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
