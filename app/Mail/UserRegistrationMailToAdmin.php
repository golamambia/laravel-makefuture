<?php
namespace App\Mail;

use App\Models\Emailtemplate;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegistrationMailToAdmin extends Mailable
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
        $email_content = $emailtemplate[0]->user_registration_email_to_admin;

        $site_title = config('site.title');
        $fullname = $this->user['name'];
        $UserDetails = $this->user['UserDetails'];

        $body_content = $email_content;
        $body_content = str_replace('{#Fullname#}', $fullname, $body_content);
        $body_content = str_replace('{#UserDetails#}', $UserDetails, $body_content);
        $body_content = str_replace('{#Sitename#}', $site_title, $body_content);


        return $this->view('layouts.email', compact('body_content'));
    }
}