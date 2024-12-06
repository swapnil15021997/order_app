<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name'               => 'Admin',
            'user_name'          => 'Admin',
            'user_phone_number'  => '1234567890',
            'email'              => 'admin@example.com',
            'user_address'       => '123 Main Street',
            'password'           => bcrypt('password123'), 
            'user_sweetword'     => 'mySweetWord',
            'user_role_id'       => 1,
            'user_module_id'     => null,
            'user_permission_id' => null,
            'is_delete'          => false,
        ]);
    }
}
