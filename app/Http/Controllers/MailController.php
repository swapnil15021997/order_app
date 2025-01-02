<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Swift_TransportException;
use Mail;
use App\Models\Email;
class MailController extends Controller
{
    //

    public function send_email($data){

        if($data['type']=='Add'){

            $subject = "Chalan Created for " .$data['order_name'];
            $message = "This is to inform you about a new chalan of type " .$data['order_name'];
        }else if($data['type']=='Edit'){
            $subject = "Chalan Updated for " .$data['order_name'];
            $message = "This is to inform you about a Update chalan of type " .$data['order_name'];
        }else if($data['type']=='Approve'){
            $subject = "Chalan Approved for " .$data['order_name'];
            $message = "This is to inform you about a Approve chalan of type " .$data['order_name'];
        }else if($data['type']=='Transfer'){
            $subject = "Chalan Transfer for " .$data['order_name'];
            $message = "This is to inform you about a Update chalan of type " .$data['order_name'];
        }
        

        $message.="\nFrom Branch Name: ".$data['order_form'];
        $message.="\nTo Branch Name: ".$data['order_to'];
        $message.="\nOrder Date: ".$data['order_date'];
        $data['message'] = $message;
        $data['subject'] = $subject;
        
        $mail = Email::create([
            'mail_order_id'=>$data['order_id'],
            'mail_from'    =>$data['mail_from'],
            'mail_to'      =>$data['mail_to'],
            'mail_cc'      =>null,
            'mail_bcc'     =>null,
            'mail_subject'=>$data['subject'],
            'mail_content'=>$data['message'],
            'mail_status' =>1,

        ]);
        try{    
            // Mail::send(['text'=>'mail'],['data' => $data], function($message) use ($data,$subject) { 
            //         $message->to($data['mail_from'])
            //                 ->subject($subject)
            //                 ->from('noreply@order_app.in');
            // });
            $mail->mail_status = 2;
            $mail->save();
        }catch (Swift_TransportException  $e) {
            \Log::info(['Error in sending mail'=>$e]);
            $mail->mail_status = 3;
            $mail->save();
        }
      
    }
}
