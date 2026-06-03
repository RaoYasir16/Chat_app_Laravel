<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->get();

        return view('chat.index', compact('users'));
    }

    public function getMessages($userId)
    {
        $myId = auth()->id();

        $messages = Message::with('sender')
            ->where(function ($q) use ($myId, $userId) {
                $q->where('sender_id', $myId)
                    ->where('receiver_id', $userId);
            })
            ->orWhere(function ($q) use ($myId, $userId) {
                $q->where('sender_id', $userId)
                    ->where('receiver_id', $myId);
            })
            ->orderBy('id', 'asc')
            ->get();

        return response()->json($messages);
    }


    public function send(Request $request)
    {
        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json($message);
    }
}
