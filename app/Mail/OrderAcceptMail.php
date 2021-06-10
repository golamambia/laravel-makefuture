<?php
namespace App\Mail;

use App\Models\Emailtemplate;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderAcceptMail extends Mailable
{
    use Queueable, SerializesModels;


    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $emailtemplate = Emailtemplate::where('id', '1')->get();
        $order_accept_email = $emailtemplate[0]->order_accept_email;

        $site_title = config('site.title');

        //$fullname = $this->user['fname'].' '.$this->user['lname'];

        $fullname = $this->user['fullname'];

        $body_content = $order_accept_email;
        $body_content = str_replace('{#Fullname#}', $fullname, $body_content);
        $body_content = str_replace('{#Firstname#}', $this->user['first_name'], $body_content);
        $body_content = str_replace('{#Email#}', $this->user['email'], $body_content);
        $body_content = str_replace('{#OrderID#}', $this->user['order_id'], $body_content);
        $body_content = str_replace('{#ProofreaderFullname#}', $this->user['proofreader_fullname'], $body_content);
        $body_content = str_replace('{#Sitename#}', $site_title, $body_content);
        $body_content = str_replace('{#Loginurl#}', url('login'), $body_content);
        $body_content = str_replace('{#MyOrderurl#}', url('my-orders'), $body_content);


        return $this->view('layouts.email', compact('body_content'));
    }
}