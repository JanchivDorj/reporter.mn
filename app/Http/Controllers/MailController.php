<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Laracasts\Flash\Flash;
use App\Http\Controllers\Controller;
use App\Mail\MailDemo;
use Illuminate\Support\Facades\Mail;
use App\SystemCode;
class MailController extends Controller
{
    //MAIL CONTENT INFORMATION
    public function send(Request $request)
    {
        $objDemo = new \stdClass();

        $objDemo->demo_one = $request->subject;
        $objDemo->demo_two = $request->message;
        $objDemo->sender   = $request->name;
        $objDemo->receiver = 'Hawaii';
        $objDemo->email    = $request->email;

        $system_code = SystemCode::where('system_name','send_email')->first();
        Mail::to($system_code->image)->send(new MailDemo($objDemo));

        flash('Амжилттай хүлээн авлаа')->success();

        return redirect('/contact-us');
    }
}


