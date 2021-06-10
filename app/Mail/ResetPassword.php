<?php

namespace App\Mail;
use App\Models\Emailtemplate;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the notification message.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\MessageBuilder
     */
    public function toMail($notifiable)
    {
        $link = url('password/reset', $this->token).'?email='.urlencode($notifiable->email);

        $emailtemplate = Emailtemplate::where('id', '1')->get();
        $forgotpass_email_content = $emailtemplate[0]->forgotpass_email;

        $site_title = config('site.title');
        $fullname = $notifiable->first_name.' '.$notifiable->last_name;

        $body_content = $forgotpass_email_content;
        $body_content = str_replace('{#Fullname#}', $fullname, $body_content);
        $body_content = str_replace('{#ResetPasswordLink#}', $link, $body_content);
        $body_content = str_replace('{#Sitename#}', $site_title, $body_content);

        return (new MailMessage)
                    ->subject('Reset Password Notification')
                    ->view('layouts.email', compact('body_content') );
                     
    }
}