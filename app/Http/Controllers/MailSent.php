<?php

namespace App\Http\Controllers;

use App\Mail\SendMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailSent extends Controller
{
    public function mail()
    {
        $name = 'Krunal';
        Mail::to('cziteya@agribank.co.zw')->send(new SendMailable($name));
        return 'Email was sent';
    }
}
