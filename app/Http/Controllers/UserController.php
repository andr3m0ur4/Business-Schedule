<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        $user = User::where('remember_token', $request->token)->first();
        $user->remember_token = null;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json($user);
    }

    public function getUsersMessage(Request $request)
    {
        $user_id_to = $request->user_id_to;
        $users = DB::getPdo()->prepare("select u.* from users u
        left join messages m ON m.user_id_from = u.id and m.user_id_to = :user_to and m.created_at = (SELECT max(m2.created_at) from messages m2 where m2.user_id_from = u.id and m2.user_id_to = :user_to2)
        where u.deleted_at is null
        ORDER by  m.created_at DESC");
        $users->bindParam('user_to', $user_id_to);
        $users->bindParam('user_to2', $user_id_to);

        $users->execute();

        return response()->json($users->fetchAll());

    }
}
