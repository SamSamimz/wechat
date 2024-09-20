<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    //__Store messages,
    public function store(Request $request)
    {
        defer(function () use ($request) {
        $message = Message::create([
            'receiver_id' => $request->receiver_id,
            'sender_id'   => $request->sender_id,
            'message'     => $request->newMessage,
        ]);
            broadcast(new MessageSent($message))->toOthers();
        });
        // event(new MessageSent($message));
        // return redirect()->route('chat', ['id' => $request->receiver_id]);
    }
}