<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActivityLog extends Model
{
    use HasFactory;

    protected $table = 'activity_log';
    
    protected $primaryKey = 'activity_id';
    protected $fillable = [
        'order_id',
        'order_trans_id',
        'order_activity',
        'user_id'
    ];

    
}
