<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Colors extends Model
{

    use HasFactory;

    protected $table = 'colors';
    protected $primaryKey = 'color_id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'color_name',
        
    ];

   
}
