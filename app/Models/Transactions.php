<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transactions extends Model
{
    //
    
    use HasFactory;

    protected $table = 'transactions';
    protected $primaryKey = 'trans_id';
    protected $fillable = [
        'trans_from',
        'trans_to',
        'trans_active_branch',
        'trans_user_id',
        'trans_order_id',
        'trans_item_id',
        'trans_date',
        'trans_time',
        'is_delete'
    ];

}
