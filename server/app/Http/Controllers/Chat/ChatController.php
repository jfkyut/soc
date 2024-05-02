<?php

namespace App\Http\Controllers\Chat;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Chat\NewMessageRequest;

class ChatController extends Controller
{
    public function index()
    {
        return Auth::user()
                    ->chats()
                    ->with('messages', function ($query) {
                        $query->latest()->limit(1);
                    })
                    ->with('participants')
                    ->orderByRaw('(SELECT MAX(created_at) FROM messages WHERE messages.chat_id = chats.id) DESC')
                    ->get();
    }

    public function store(NewMessageRequest $request)
    {
        $participants = $request->validated('participants');

        $chatIdQuery = DB::table('chats')
            ->select('id')
            ->whereExists(function ($query) use ($participants) {
                $query->select(DB::raw(1))
                    ->from('participants')
                    ->whereIn('user_id', $participants)
                    ->whereRaw('chat_id = chats.id')
                    ->groupBy('chat_id')
                    ->havingRaw('COUNT(DISTINCT user_id) = ?', [count($participants)]);
            });

        $chat = Chat::whereIn('id', $chatIdQuery)->first();

        if (!$chat) {
            // If no chat is found, create a new one
            $chat = Chat::create();
            foreach ($participants as $participant) {
                $chat->participants()->attach($participant);
            }
        }

        $message = new Message([
            'content' => $request->validated('content'),
        ]);

        $message->sender()->associate($request->user());
        $message->chat()->associate($chat);
        $message->type()->associate($request->input('type'));
        $message->timestamp = now()->format('H:i');
        $message->save();

        return response([
            'chat' => $chat->where('id', $chat->id)
                            ->with('messages', function ($query) {
                                $query->latest()->limit(1);
                            })
                            ->with('participants')
                            ->first(),
            'message' => $message->load('chat', 'type', 'sender')
        ]);
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
