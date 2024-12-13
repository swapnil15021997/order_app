<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Modules;
class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Modules::create([
            'module_name' => 'Branch',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Modules::create([
            'module_name' => 'Order',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Modules::create([
            'module_name' => 'User',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Modules::create([
            'module_name' => 'Role',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
