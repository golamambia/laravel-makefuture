<?php
namespace App\Mail;

use App\Models\Emailtemplate;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentReleaseRequestMailToAdmin extends Mailable
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
        $release_request_email = $emailtemplate[0]->release_request_email_to_admin;

        $site_title = config('site.title');

        $fullname = $this->user['fullname'];
        $earning_amount = $this->user['earning_amount'];
        $email = $this->user['email'];

        $body_content = $release_request_email;
        $body_content = str_replace('{#Fullname#}', $fullname, $body_content);
        $body_content = str_replace('{#Email#}', $email, $body_content);
        $body_content = str_replace('{#Earningamount#}', $earning_amount, $body_content);
        $body_content = str_replace('{#Sitename#}', $site_title, $body_content);
        $body_content = str_replace('{#Loginurl#}', url('login'), $body_content);


        return $this->view('layouts.email', compact('body_content'));
    }
}