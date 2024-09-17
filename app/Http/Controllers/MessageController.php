<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    //__Store messages,
    public function store(Request $request)
    {

        // dd($request->all());
        Message::create([
            'receiver_id' => $request->receiver_id,
            'sender_id' => $request->sender_id,
            'message' => $request->newMessage,
        ]);

        return redirect()->route('chat', ['id' => $request->receiver_id]);
    }
}