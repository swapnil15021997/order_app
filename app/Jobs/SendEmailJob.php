<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Http\Controllers\MailController;
use App\Models\Order;
use App\Models\Transactions;
use App\Models\Branch;
use App\Models\Settings;



class SendEmailJob implements ShouldQueue
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
        
        $settings = Settings::where('setting_name','email')->first();
        
        if($order['order_type'] == 1){
            $order_type = 'Order';
        }else{
            $order_type = 'Reparing';
        }
        if($this->type == "Approve" || $this->type == "Transfer"){
            $trans   = Transactions::get_trans_by_order($order['order_id']);
            
            $to_site = $trans->trans_to;
            $site    = Branch::get_branch_by_id($to_site);

            $mail_data = [
                'mail_to'     => $settings['setting_value'],
                'mail_from'   => 'noreply@example.com',
                'order_form'  => $order['order_from_name'],
                'order_to'    => $site->branch_name,
                'order_id'    => $order['order_id'],
                'order_type'  => $order['order_type'],
                'order_name'  => $order_type,
                'order_date'  => $order['order_date'],
                'item_name'   => $order['item_name'],
                'item_metal'  => $order['item_metal'],
                'item_melting'=> $order['item_melting'],
                'item_weight' => $order['item_weight'],
                'type'        => $this->type,
            ];
        }
        
        if($this->type == "Add" || $this->type == "Edit"){

            $mail_data = [
                'mail_to'     => $settings['setting_value'],
                'mail_from'   => 'noreply@example.com',
                'order_form'  => $order['order_from_name'],
                'order_to'    => $order['order_to_name'],
                'order_id'    => $order['order_id'],
                'order_type'  => $order['order_type'],
                'order_name'  => $order_type,
                'order_date'  => $order['order_date'],
                'item_name'   => $order['item_name'],
                'item_metal'  => $order['item_metal'],
                'item_melting'=> $order['item_melting'],
                'item_weight' => $order['item_weight'],
                'type'        => $this->type,
            ];
        }
    
        $mail = new MailController();
        $mail->send_email($mail_data);
    }
}
