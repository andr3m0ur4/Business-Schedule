<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Str;

class MailController extends Controller
{
    public function sendMail(ChangePasswordRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        $token = Str::random(64);
        User::where('id', $user->id)->update(['remember_token' => $token]);

        Mail::send('email.verify', ['token' => $token, 'url' => env('APP_URL')], function($message) use($user) {
            $message->to($user->email);
            $message->subject('Atualização de Senha');
        });

        return response()->json($user);
    }

    public function verifyResetPassword(Request $request)
    {
        $user = User::where('remember_token', $request->token)->first();
        $error = is_null($user);
        return response()->json(['error' => $error]);
    }
}
