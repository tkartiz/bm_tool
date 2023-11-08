<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\User;
use App\Models\Application;

class ContactSendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user_name;
    public $application_id;
    public $subject;
    public $email;
    public $title;
    public $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($inputs)
    {
        $this->user_name  = User::find($inputs['user_id']);
        $this->email = $inputs['email'];
        $this->application_id = $inputs['application_id'];
        $this->subject = Application::find($inputs['application_id'])->subject;
        $this->title = $inputs['title'];
        $this->message = $inputs['message'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('お問い合わせありがとうございます')
            ->view('contacts.user')
            ->with([
                'user_name' => $this->user_name,
                'email' => $this->email,
                'application_id' => $this->application_id,
                'subject' => $this->subject,
                'title' => $this->title ? $this->title : null,
                'body' => $this->message ? $this->message : null
            ]);
    }
}

