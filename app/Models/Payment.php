<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';
    protected $primaryKey = 'payment_id';
    protected $fillable = [
        'payment_order_id',
        'payment_booking_rate',
        'payment_customer_id',
        'payment_advance_cash',
        'payment_date',
        'is_delete'
    ];

    //
}