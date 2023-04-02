<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createBaseUsers();
    }

    public function createBaseUsers()
    {
        // Super-Admin
        User::create([
            'uuid' => '8f7783ec56',
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'phone' => '12345678',
            'address' => 'Somewhere around the world.',
            'description' => 'Super admin for event managment.',
            'status' => User::STATUS_ACTIVE,
            'created_at' => Carbon::now()
        ])->assignRole('super_admin');

    }

   
}
