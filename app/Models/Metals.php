<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Metals extends Model
{

    use HasFactory;

    protected $table = 'metals';
    protected $primaryKey = 'metal_id';
    
    protected $fillable = [
        'metal_name',
        
    ];

}
