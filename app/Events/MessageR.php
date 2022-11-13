<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Message;

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