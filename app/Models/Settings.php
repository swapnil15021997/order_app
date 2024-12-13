<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Settings extends Model
{
    //
    
    use HasFactory;

    protected $table = 'settings';
    protected $primaryKey = 'setting_id';
    protected $fillable = [
        'setting_name',
        'setting_value',
        'setting_status',
        'setting_expired',
    ];
}
