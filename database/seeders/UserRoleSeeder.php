<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserRole;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $moduleIds       = implode(',', [1,2,3,4]);
        $permissionIds   = implode(',', [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18]);
        UserRole::create([
            'role_name'           => 'Admin',
            'role_status'         => 1, // 1: Active
            'role_module_ids'     => $moduleIds,
            'role_permission_ids' => $permissionIds
        ]);

        $manager_moduleIds       = implode(',', [1,2]);
        $manager_permissionIds   = implode(',', [1,2,3,4,5,6,7,8]);
       
        UserRole::create([
            'role_name'           => 'Manager',
            'role_status'         => 1, // 1: Active
            'role_module_ids'     => $manager_moduleIds,
            'role_permission_ids' => $manager_permissionIds

        ]);

        $salesman_moduleIds       = implode(',', [1,2]);
        $salesman_permissionIds   = implode(',', [1,5]);
       
        UserRole::create([
            'role_name'           => 'Salesman',
            'role_status'         => 1, // 1: Active,
            'role_module_ids'     => $salesman_moduleIds,
            'role_permission_ids' => $salesman_permissionIds
        ]);
        
    }
}
