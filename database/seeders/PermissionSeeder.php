<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use Carbon\Carbon;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Permission::create([
            'permission_name'     => 'read',
            'permission_module_id'=> 1,
            'created_at'          => Carbon::now(),
            'updated_at'          => Carbon::now(),
        ]);
        Permission::create([
            'permission_name'     => 'update',
            'permission_module_id'=> 1,
            'created_at'          => Carbon::now(),
            'updated_at'          => Carbon::now(),
        ]);
        Permission::create([
            'permission_name'     => 'create',
            'permission_module_id'=> 1,
            'created_at'          => Carbon::now(),
            'updated_at'          => Carbon::now(),
        ]);
        Permission::create([
            'permission_name'     => 'delete',
            'permission_module_id'=> 1,
            'created_at'          => Carbon::now(),
            'updated_at'          => Carbon::now(),
        ]);


        // Orders
        Permission::create([
            'permission_name'     => 'read',
            'permission_module_id'=> 2,
            'created_at'          => Carbon::now(),
            'updated_at'          => Carbon::now(),
        ]);
        Permission::create([
            'permission_name'     => 'update',
            'permission_module_id'=> 2,
            'created_at'          => Carbon::now(),
            'updated_at'          => Carbon::now(),
        ]);
        Permission::create([
            'permission_name'     => 'create',
            'permission_module_id'=> 2,
            'created_at'          => Carbon::now(),
            'updated_at'          => Carbon::now(),
        ]);
        Permission::create([
            'permission_name'     => 'delete',
            'permission_module_id'=> 2,
            'created_at'          => Carbon::now(),
            'updated_at'          => Carbon::now(),
        ]);


        // User
        Permission::create([
            'permission_name'     => 'read',
            'permission_module_id'=> 3,
            'created_at'          => Carbon::now(),
            'updated_at'          => Carbon::now(),
        ]);
        Permission::create([
            'permission_name'     => 'update',
            'permission_module_id'=> 3,
            'created_at'          => Carbon::now(),
            'updated_at'          => Carbon::now(),
        ]);
        Permission::create([
            'permission_name'     => 'create',
            'permission_module_id'=> 3,
            'created_at'          => Carbon::now(),
            'updated_at'          => Carbon::now(),
        ]);
        Permission::create([
            'permission_name'     => 'delete',
            'permission_module_id'=> 3,
            'created_at'          => Carbon::now(),
            'updated_at'          => Carbon::now(),
        ]);

        // Role


        Permission::create([
            'permission_name'     => 'read',
            'permission_module_id'=> 4,
            'created_at'          => Carbon::now(),
            'updated_at'          => Carbon::now(),
        ]);
        Permission::create([
            'permission_name'     => 'update',
            'permission_module_id'=> 4,
            'created_at'          => Carbon::now(),
            'updated_at'          => Carbon::now(),
        ]);
        Permission::create([
            'permission_name'     => 'create',
            'permission_module_id'=> 4,
            'created_at'          => Carbon::now(),
            'updated_at'          => Carbon::now(),
        ]);
        Permission::create([
            'permission_name'     => 'delete',
            'permission_module_id'=> 4,
            'created_at'          => Carbon::now(),
            'updated_at'          => Carbon::now(),
        ]);

        // Transfer and Approve permissions
        Permission::create([
            'permission_name'     => 'order approve',
            'permission_module_id'=> 2,
            'created_at'          => Carbon::now(),
            'updated_at'          => Carbon::now(),
        ]);
        Permission::create([
            'permission_name'     => 'order transfer',
            'permission_module_id'=> 2,
            'created_at'          => Carbon::now(),
            'updated_at'          => Carbon::now(),
        ]);
    }
}
