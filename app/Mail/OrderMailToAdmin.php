<?php
namespace App\Mail;

use App\Models\Emailtemplate;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderMailToAdmin extends Mailable
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
        $order_email = $emailtemplate[0]->order_email_to_admin;

        $site_title = config('site.title');

        //$fullname = $this->user['fname'].' '.$this->user['lname'];

        $fullname = $this->user['fullname'];

        $body_content = $order_email;
        $body_content = str_replace('{#Fullname#}', $fullname, $body_content);
        $body_content = str_replace('{#Email#}', $this->user['email'], $body_content);
        $body_content = str_replace('{#Statename#}', $this->user['state_name'], $body_content);
        $body_content = str_replace('{#Collegename#}', $this->user['college_name'], $body_content);
        $body_content = str_replace('{#Academicyear#}', $this->user['academic_year'], $body_content);
        $body_content = str_replace('{#Coursename#}', $this->user['course_name'], $body_content);
        $body_content = str_replace('{#TransactionID#}', $this->user['transaction_id'], $body_content);
        $body_content = str_replace('{#Sitename#}', $site_title, $body_content);
        $body_content = str_replace('{#Loginurl#}', url('login'), $body_content);


        return $this->view('layouts.email', compact('body_content'));
    }
}