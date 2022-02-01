<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailDemo extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    
    public $demo;
    
    public function __construct($demo)
    {
        $this->demo = $demo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->demo->email)
                    ->view('mails.demo')
                    ->text('mails.demo_plain')
                    ->with(
                    [
                        'subject' => $this->demo->demo_one,
                        'message' => $this->demo->demo_two,
                    ]);  
                    
                    // ->attach(public_path('/images').'/demo.jpg', [
                    //         'as' => 'demo.jpg',
                    //         'mime' => 'image/jpeg',
                    // ]);
    }
}


// $objDemo = new \stdClass();
// $objDemo->subject  = $request->subject;
// $objDemo->message = $request->message;
// $objDemo->sender   = $request->name;
// $objDemo->receiver = 'SSSS';
// $objDemo->email    = $request->email;

// Mail::to("janaapebor@gmail.com")->send(new MailDemo($objDemo));