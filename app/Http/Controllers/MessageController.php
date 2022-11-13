<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Events\MessageR;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Message::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreMessageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = Message::create($request->messageInfo);
        event(new MessageR($message, $request->canal));
        return response()->json($message, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        return response()->json($message);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        $message->fill($request->validated());

        $message->save();

        return response()->json($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        $message->delete();
        return response()->json($message);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getMessages(Request $request){

        return response()->json(Message::where([
            ['user_id_to', '=', $request->user_id_to],
            ['user_id_from', '=', $request->user_id_from],
        ])->orWhere([
            ['user_id_to', '=', $request->user_id_from],
            ['user_id_from', '=', $request->user_id_to] ])->orderBy('created_at', 'asc')->get());

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function readMessages(Request $request){

        return response()->json(Message::where([
            ['user_id_to', '=', $request->user_id_from],
            ['user_id_from', '=', $request->user_id_to],
            ['read', '=', 'N']
        ])->update(['read' => 'S']));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function recentMessages(Request $request){

        $user_id_to = $request->user_id_to;
        $users = DB::getPdo()->prepare("SELECT u.id, u.name, m.message FROM users u
        INNER JOIN messages m ON m.user_id_from = u.id AND m.user_id_to = :user_to AND m.created_at = (SELECT MAX(m2.created_at) FROM messages m2 WHERE m2.user_id_from = u.id AND m2.user_id_to = :user_to_s) AND m.read = 'N'
        ORDER BY  m.created_at DESC LIMIT 3");
        $users->bindParam('user_to', $user_id_to);
        $users->bindParam('user_to_s', $user_id_to);

        $users->execute();

        return response()->json($users->fetchAll());

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function countRecentMessages(Request $request){

        $user_id_to = $request->user_id_to;
        $result = DB::getPdo()->prepare("SELECT COUNT(u.name) num FROM users u
        INNER JOIN messages m ON m.user_id_from = u.id AND m.user_id_to = :user_to AND m.created_at = (SELECT MAX(m2.created_at)
        FROM messages m2 WHERE m2.user_id_from = u.id AND m2.user_id_to = :user_to_s) AND m.read = 'N'");
        $result->bindParam('user_to', $user_id_to);
        $result->bindParam('user_to_s', $user_id_to);

        $result->execute();

        return response()->json($result->fetchAll()[0][0]);

    }

}
