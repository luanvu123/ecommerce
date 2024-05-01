<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
           'user-list',
           'user-create',
           'user-edit',
           'user-delete',
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'product-list',
           'product-create',
           'product-edit',
           'product-delete',
           'category-list',
           'category-create',
           'category-edit',
           'category-delete',
           'attribute-list',
            'attribute-create',
            'attribute-edit',
            'attribute-delete',
            'meta-list',
            'meta-create',
            'meta-edit',
            'meta-delete',
            'poster-list',
            'poster-create',
            'poster-edit',
            'poster-delete',
            'policy-list',
            'policy-create',
            'policy-edit',
            'policy-delete',
            'inventory-list',
            'inventory-create',
            'inventory-edit',
            'inventory-delete',
            'outgoingproduct-list',
            'outgoingproduct-create',
            'outgoingproduct-edit',
            'outgoingproduct-delete',
            'coupon-list',
            'coupon-create',
            'coupon-edit',
            'coupon-delete',
            'shipping-list',
            'shipping-create',
            'shipping-edit',
            'shipping-delete',
            'supplier-list',
            'supplier-create',
            'supplier-edit',
            'supplier-delete',
            'customer-list',
            'customer-create',
            'customer-edit',
            'customer-delete',
            'order-list',
            'order-create',
            'order-edit',
            'order-delete',
            'about-list',
            'about-create',
            'about-edit',
            'about-delete',
        ];

        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
