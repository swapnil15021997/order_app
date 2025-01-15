<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Branch;

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
        'is_delete',
        'trans_status',
        'trans_approved_by'
    ];

    public static function get_trans_by_id($trans_id){
        $trasnaction = Transactions::where('trans_id', $trans_id)
        ->where('trans_status',0)
        ->get()
        ->first();
        return $trasnaction;
    }


    public static function get_trans_by_order_id($order_id){
        $trasnaction = Transactions::where('trans_order_id', $order_id)
        ->where('trans_status',0)
        ->get()
        ->first();
        return $trasnaction;
    }

    public static function get_trans_by_order($order_id)
    {
        $trasnaction = Transactions::where('trans_order_id', $order_id)
            ->where('trans_status',1)
            ->orderBy('trans_id', 'desc')
            ->first();
        return $trasnaction;

    }
    public function transUser()
    {
        return $this->belongsTo(User::class, 'trans_user_id');
    }

    public function transApprovedBy()
    {
        return $this->belongsTo(User::class, 'trans_approved_by');
    }

    public function trans_from()
    {
        return $this->belongsTo(Branch::class, 'trans_from', 'branch_id');
    }

    public function trans_to()
    {
        return $this->belongsTo(Branch::class, 'trans_to', 'branch_id');
    }

}
