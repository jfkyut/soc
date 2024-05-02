<?php

namespace App\Http\Controllers\Chat;

use App\Models\Chat;
use App\Models\Message;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use App\Http\Requests\Chat\NewMessageRequest;

class ChatController extends Controller
{
    public function index()
    {
        return Auth::user()
                    ->chats()
                    ->with('participants')
                    ->with('messages', function($query) {
                        $query->latest()->limit(1);
                    })
                    ->orderByDesc('updated_at')
                    ->get();
    }

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
        $message->timestamp = Date::now()->format('H:i');
        $message->save();

        return $message->with('chat')
                        ->with('type')
                        ->with('sender')
                        ->where('id', $message->id)
                        ->first();
    }

    public function show(Chat $chat)
    {
        return Message::where('chat_id', $chat->id)
                        ->with('chat')
                        ->with('type')
                        ->with('sender')
                        ->orderBy('created_at')
                        ->get();
    }
}
