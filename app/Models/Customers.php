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
        $customer = Customers::where('cust_id',$cust_id)->where('is_delete',1)->first();
        return $customer;
    }


    public static function get_all_customers(){
        $customer = Customers::where('is_delete',0)->get()->toArray();
        return $customer;
    }
    

}
