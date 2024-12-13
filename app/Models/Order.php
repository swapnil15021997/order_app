<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Item;
use DB;
class Order extends Model
{
    use HasFactory;
 

    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_date',
        'order_number',
        'order_qr_code',
        'order_from_branch_id',
        'order_to_branch_id',
        'order_user_id',
        'order_type'
    ];


    public static function get_order_by_qr_number_id($qr_number){
        $order = Order::where('order_qr_number',$qr_number)->where('is_delete',1)->first();
        return $order;
    }

    public static function get_order_by_number_id($order_number){
        $order = Order::where('order_number',$order_number)->where('is_delete',1)->first();
        return $order;
    }

    public static function get_order_by_id($order_id){
        $order = Order::where('order_id',$order_id)->where('is_delete',1)->first();
        return $order;
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'item_order_id', 'order_id');
    }

    // public static function get_order_with_items($order_id)
    // {
    //     $order = Order::where('order_id', $order_id)
    //                 ->where('is_delete', 0)
    //                 ->with('items') 
    //                 ->first();

    //     return $order;
    // }
    
    public static function get_latest_order(){
        $ordersQuery = Order::query()    
        ->leftJoin('branch AS from_branch', 'from_branch.branch_id', '=', 'orders.order_from_branch_id')  // Join to get 'order_from_branch' name
        ->leftJoin('branch AS to_branch', 'to_branch.branch_id', '=', 'orders.order_to_branch_id')  // Join to get 'order_to_branch' name
        ->select(
            'orders.*', 
            'from_branch.branch_name AS order_from_name',   
            'to_branch.branch_name AS order_to_name')
        ->where('orders.is_delete',0)
        ->take(5)
        ->orderBy('order_id', 'desc')
        ->get()
        ->toArray();

        return $ordersQuery;

    }
    public static function get_order_with_items($order_id)
{
    $order = Order::where('order_id', $order_id)
                  ->where('is_delete', 0)
                  ->with('items')
                  ->first();
    if ($order) {
        foreach ($order->items as $item) {
            $item->files = File::whereIn('file_id', explode(',', $item->item_file_images))->get();
        }
    }
    return $order;
}


}
