<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\Mail as MailModel;


class MailController extends Controller
{

    public function sendMail(Request $request)
    {
    
        Mail::to($request->mail)->send(new MailModel());
        return 'Email enviado com sucesso';

    }
}
