<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempOrders extends Model
{
    protected $table = 'temp_orders';
    protected $primaryKey = 'temp_order_id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'temp_notes_id',
        
    ];
}
