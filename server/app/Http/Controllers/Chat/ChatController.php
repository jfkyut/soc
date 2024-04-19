<?php

namespace App\Http\Controllers\Chat;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Chat\NewMessageRequest;

class ChatController extends Controller
{
    public function store(NewMessageRequest $request)
    {
        $chat = Chat::create();
        
        foreach ($request->validated('participants') as $participant) {
            $chat->participants()->attach($participant);
        }

        $chat->save();

        $message = new Message([
            'content' => $request->validated('content'),
        ]);

        $message->sender()->associate($request->user());
        $message->chat()->associate($chat);
        $message->type()->associate($request->input('type'));
        $message->save();

        return $message->with('chat')
                        ->with('type')
                        ->with('sender')
                        ->where('id', $message->id)
                        ->first();
    }
}
