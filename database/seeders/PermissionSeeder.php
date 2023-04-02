<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('permissions')->truncate();
        Schema::enableForeignKeyConstraints();
        $now = Carbon::now();

        $permissions = [];

        /**
         * Allergens
         */
        $permissions = array_merge($permissions, [
            ['name' => 'allergen.*', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'allergen.add', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'allergen.view', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'allergen.update', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'allergen.delete', 'guard_name' => 'web', 'created_at' => $now],
        ]);

        /**
         * Categories & Sub-Categories
         */
        $permissions = array_merge($permissions, [
            // categories
            ['name' => 'category.*', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'category.add', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'category.view', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'category.update', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'category.delete', 'guard_name' => 'web', 'created_at' => $now],

            // sub-categories
            ['name' => 'category.sub.*', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'category.sub.add', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'category.sub.view', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'category.sub.update', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'category.sub.delete', 'guard_name' => 'web', 'created_at' => $now],
        ]);

        /**
         * Tables
         */
        $permissions = array_merge($permissions, [
            ['name' => 'table.*', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'table.add', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'table.view', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'table.update', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'table.delete', 'guard_name' => 'web', 'created_at' => $now],
        ]);

        /**
         * Discounts
         */
        $permissions = array_merge($permissions, [
            ['name' => 'discount.*', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'discount.add', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'discount.view', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'discount.update', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'discount.delete', 'guard_name' => 'web', 'created_at' => $now],
        ]);

        /**
         * Addons
         */
        $permissions = array_merge($permissions, [
            ['name' => 'addon.*', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'addon.add', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'addon.view', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'addon.update', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'addon.delete', 'guard_name' => 'web', 'created_at' => $now],
        ]);

        /**
         * Variations
         */
        $permissions = array_merge($permissions, [
            ['name' => 'variation.*', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'variation.add', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'variation.view', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'variation.update', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'variation.delete', 'guard_name' => 'web', 'created_at' => $now],
        ]);

        /**
         * Events
         */
        $permissions = array_merge($permissions, [
            ['name' => 'event.*', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'event.add', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'event.view', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'event.update', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'event.delete', 'guard_name' => 'web', 'created_at' => $now],
        ]);

        /**
         * Vendors
         */
        $permissions = array_merge($permissions, [
            ['name' => 'vendor.*', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'vendor.add', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'vendor.view', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'vendor.update', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'vendor.delete', 'guard_name' => 'web', 'created_at' => $now],
        ]);

        /**
         * Products
         */
        $permissions = array_merge($permissions, [
            ['name' => 'product.*', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'product.add', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'product.view', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'product.update', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'product.delete', 'guard_name' => 'web', 'created_at' => $now],
        ]);

        /**
         * Notifications
         */
        $permissions = array_merge($permissions, [
            ['name' => 'notification.*', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'notification.add', 'guard_name' => 'web', 'created_at' => $now],
        ]);

        /**
         * Orders
         */
        $permissions = array_merge($permissions, [
            ['name' => 'order.*', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'order.add', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'order.view', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'order.update', 'guard_name' => 'web', 'created_at' => $now],
            ['name' => 'order.delete', 'guard_name' => 'web', 'created_at' => $now],
        ]);

        Permission::insert($permissions);
    }
}
