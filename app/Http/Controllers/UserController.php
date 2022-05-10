<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(User::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'type' => $request->type,
            'phone' => $request->phone,
            'job_id' => $request->job_id
        ]);

        return response()->json($user, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json($user);
    }

    
    public function sendMail(Request $request)
    {

        $user = User::where('email', $request->email)->first();
        $token = Str::random(64);
        User::where('id', $user->id)->update(['remember_token' => $token]);
        // return new ResetPasswordMail();
        // Mail::to('fohoci5438@ovout.com')->send(new ResetPasswordMail($user), ['token' => $token]);
        
        // Mail::send(new ResetPasswordMail(), ['token' => $token], function($message) use($request){
        //     $message->to('fohoci5438@ovout.com');
        //     $message->subject('Reset Password');
        // });
        Mail::send('email.verify', ['token' => $token, 'url' => env('APP_DNS_URL')], function($message) use($user){
            $message->to($user->email);
            $message->subject('Atualização de Senha');
        });

        return response()->json($user);
    }

    public function verifyResetPassword(Request $request){

        $user = User::where('remember_token', $request->token)->first();

        if (!$user) {
            
            return response()->json(['error' => true]);
        }
        
        return response()->json(['error' => false]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(ChangePasswordRequest $request){

        $user = User::where('remember_token', $request->token)->first();
        //$user->remember_token = null;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(['usuario' => $user->email]);

    }
}
