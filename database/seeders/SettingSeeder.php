<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Settings;
use Carbon\Carbon;
class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Settings::create([
            
                'setting_name' => 'email',
                'setting_value' => 'admin@example.com', 
                'setting_status' => 'active',
                'setting_expired' => null, 
                'is_delete' => false, 
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
        ]);
        Settings::create([
                'setting_name' => 'logo',
                'setting_value' => null, 
                'setting_status' => 'active',
                'setting_expired' => null,
                'is_delete' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
        ]);
        Settings::create([
                'setting_name' => 'notification_icon',
                'setting_value' => null, 
                'setting_status' => 'active',
                'setting_expired' => null,
                'is_delete' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
        ]);
        Settings::create([
                'setting_name' => 'fcm_token',
                'setting_value' => null, 
                'setting_status' => 'active',
                'setting_expired' => null,
                'is_delete' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
        ]);
    }
}
