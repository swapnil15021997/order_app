<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    //

    use HasFactory;

    protected $table = 'notifications';
    protected $primaryKey = 'noti_id';
 
    // Define the fillable fields
    protected $fillable = [
        'noti_status',
        'noti_user_ids',
        'noti_type',
        'noti_order_id',
        'noti_title',
        'noti_message',
        'noti_read_by',
        'noti_deleted_by',
        'noti_failed_reason'
    ];
}
