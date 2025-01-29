<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Melting extends Model
{

    use HasFactory;

    protected $table = 'melting';
    protected $primaryKey = 'melting_id';
   
    protected $fillable = [
        'melting_name',
        
    ];

}
