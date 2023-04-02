<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // super admin will bypass all the permissions checks from AuthServiceProvider
        Role::create(['name' => 'super_admin', 'guard_name' => 'web']);

        Role::create(['name' => 'vendor', 'guard_name' => 'web'])->givePermissionTo(
            [
                'allergen.add',
                'allergen.view',
                'allergen.update',
                'allergen.delete',

                'addon.add',
                'addon.view',
                'addon.update',
                'addon.delete',

                'discount.add',
                'discount.view',
                'discount.update',
                'discount.delete',
              
                'category.add',
                'category.view',
                'category.update',
                'category.delete',

                'product.add',
                'product.view',
                'product.update',
                'product.delete',

                'variation.add',
                'variation.view',
                'variation.update',
                'variation.delete',

                'order.view',
                'order.delete',
            ]
        );

        Role::create(['name' => 'customer', 'guard_name' => 'web']);
    }
}
