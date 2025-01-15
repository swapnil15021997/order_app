<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Order;
use App\Models\User;
use App\Models\Transactions;
use App\Models\Branch;
use App\Models\Notification;
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
        ->leftJoin('branch AS from_branch', 'from_branch.branch_id', '=', 'orders.order_from_branch_id') 
        ->leftJoin('branch AS to_branch', 'to_branch.branch_id', '=', 'orders.order_to_branch_id')  
        ->leftJoin('items as item', 'item.item_order_id', '=', 'orders.order_id')  
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

        if($this->type=="Add"){
            $type=1;
        }else{
            $type=2;
        }
        $data = [];

         
        if($order['order_type'] == 1){
            $data['order_name'] = 'Order';
        }else{
            $data['order_name'] = 'Reparing';
        }
        
        if($this->type=='Add'){

            $subject = "Chalan Created for " .$data['order_name'];
            $message = "This is to inform you about a new chalan of type " .$data['order_name'];
            $message.="\nFrom Branch Name: ".$order['order_form'];
            $message.="\nTo Branch Name: ".$order['order_to'];
         
        }else if($this->type=='Edit'){
            $subject = "Chalan Updated for " .$data['order_name'];
            $message = "This is to inform you about a Update chalan of type " .$data['order_name'];
            $message.="\nFrom Branch Name: ".$order['order_form'];
            $message.="\nTo Branch Name: ".$order['order_to'];
         
        }else if($this->type=='Transfer'){
            $subject = "Chalan Transfer for " .$data['order_name'];
            $message = "This is to inform you about a Transfer chalan of type " .$data['order_name'];
            $trans   = Transactions::get_trans_by_order($order['order_id']);
            $to_site = $trans->trans_to;
            $site    = Branch::get_branch_by_id($to_site);
            $message.="\nFrom Branch Name: ".$order['order_form'];
            $message.="\nTo Branch Name: ".$site->site_name;
         
        }else if($this->type=='Approve'){
            $subject = "Chalan Approved for " .$data['order_name'];
            $message = "This is to inform you about a Approval of chalan of type " .$data['order_name'];
            $trans   = Transactions::get_trans_by_order($order['order_id']);
            $to_site = $trans->trans_to;
            $site    = Branch::get_branch_by_id($to_site);
            $message.="\nFrom Branch Name: ".$order['order_form'];
            $message.="\nTo Branch Name: ".$site->site_name;
         
        }
        

        $message.="\nOrder Date: ".$order['order_date'];
        $data['title'] = $message;
        $data['body'] = $subject;
        
        
        $noti_data = [];
        $noti = Notification::create([
            'noti_status'       => 1,
            'noti_user_ids'     => null,
            'noti_type'         => $type,
            'noti_order_id'     => $order->order_id,
            'noti_title'        => $data['title'],
            'noti_message'      => $data['body'],    
            'noti_read_by'      => null,    
            'noti_deleted_by'   => null,
            'noti_failed_reason'=> null
        ]);

        $data['noti_id'] = $noti->noti_id;
        $user_ids = [];
        $noti_data = [];
        foreach($users as $user){
            $user_ids[] = $user['id'];

            $noti_data['title']     = $data['title'];
            $noti_data['body']      = $data['body'];
            $noti_data['fcm_token'] = $user['user_fcm_token'];
            $noti_data['noti_id']   = $data['noti_id'];
            $dash = new DashboardController();
            $not = $dash->sendFirebaseNotification($noti_data);
            
        }
        $noti->save([
            'noti_user_ids' => implode(',', $user_ids),
        ]);

    }
}
