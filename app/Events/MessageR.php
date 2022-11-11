<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Message;
use Illuminate\Support\Facades\Date;
use Illuminate\Validation\Rules\In;
use Psy\Readline\Hoa\Console;

class MessageR implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Message $message;
    public string $nome;


    public function __construct(Message $message, string $nome)
    {
        $this->message = $message;
        $this->nome = $nome;
    }

    public function broadcastOn()
    {
        return [$this->nome];
    }

    public function broadcastAs()
    {
        return 'messageR';
    }
}




//public $id;
//public $message;
//public $read;
//public $updated_at;
//public $created_at;
//public $deleted_at;
//public $user_id_from;
//public $user_id_to;


    //$id, $message, $read, $updated_at, $created_at, $deleted_at, $user_id_from, $user_id_to)

    //$this->message = $message;
    //$this->$id = $id;

    //$this->$read = $read;
    //$this->$updated_at = $updated_at;
    //$this->$created_at = $created_at;
    //$this->$deleted_at = $deleted_at;
    //$this->$user_id_from = $user_id_from;
    //$this->$user_id_to = $user_id_to;