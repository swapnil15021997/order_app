<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customers extends Model
{
    use HasFactory;

    protected $table = 'customers';
    
    protected $primaryKey = 'cust_id';
    protected $fillable = [
        'cust_name',
        'cust_address',
        'cust_phone_no',
    ];


    public static function get_cust_by_id($cust_id){
        $customer = Customer::where('cust_id',$cust_id)->first();
        return $customer;
    }

}
