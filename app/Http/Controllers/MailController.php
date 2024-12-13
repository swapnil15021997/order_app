<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Swift_TransportException;
use Mail;
class MailController extends Controller
{
    //

    public function send_email($data){

        $subject = "Chalan Created for " .$data['order_name'];
      
        $message = "This is to inform you about a new chalan of type " .$data['order_name'];

        $message.="\nFrom Branch Name: ".$data['order_form'];
        $message.="\nTo Branch Name: ".$data['order_to'];
        $message.="\nOrder Date: ".$data['order_date'];
        $data['message'] = $message;
        try{    
            Mail::send(['text'=>'mail'],['data' => $data], function($message) use ($data,$subject) { 
                    $message->to($data['mail_from'])
                            ->subject($subject)
                            ->from('noreply@order_app.in');
            });

        }catch (Swift_TransportException  $e) {
             
        }
      
    }
}
