<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Order;
use App\Models\User;
use App\Http\Controllers\DashboardController;


class SendNotification implements ShouldQueue
{
    use Queueable;
    public $order_id;
    public $type;

    /**
     * Create a new job instance.
     */
    public function __construct($order_id,$type)
    {
        //
        $this->order_id = $order_id;
        $this->type     = $type;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $order = Order::query()    
        ->leftJoin('branch AS from_branch', 'from_branch.branch_id', '=', 'orders.order_from_branch_id')  // Join to get 'order_from_branch' name
        ->leftJoin('branch AS to_branch', 'to_branch.branch_id', '=', 'orders.order_to_branch_id')  // Join to get 'order_to_branch' name
        ->leftJoin('items as item', 'item.item_order_id', '=', 'orders.order_id')  // Join to get 'order_to_branch' name
    
        ->select(
            'orders.*', 
            'item.*',
            'from_branch.branch_name AS order_from_name',   
            'to_branch.branch_name AS order_to_name')
        ->where('orders.is_delete',0)
        ->where('order_id',$this->order_id)->first();
        
        $get_users = [$order->order_from_branch_id, $order->order_to_branch_id];
        $comma_separated_ids = implode(',', $get_users);
        $users = User::query()
        ->where(function ($query) use ($get_users) {
            foreach ($get_users as $site_id) {
                $query->orWhereRaw("FIND_IN_SET(?, user_branch_ids)", [$site_id]);
            }
        })
        ->get()
        ->toArray();
        
        $noti_data = [];
        foreach($users as $user){
            
            $noti_data['title']     = 'CHALAN CREATED SUCCESSFULLY';
            $noti_data['body']      = 'CHALAN CREATED SUCCESSFULLY';
            $noti_data['fcm_token'] = $user['user_fcm_token'];
            $dash = new DashboardController();
            $not = $dash->sendFirebaseNotification($noti_data);
    
        }

    }
}
