<?php

namespace App\Http\Controllers\Chat;

use App\Events\Chat\RenewChat;
use App\Models\Chat;
use App\Models\Message;
use App\Events\Chat\MessageSent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Date;
use App\Http\Requests\Chat\MessageRequest;

class MessageController extends Controller
{
    public function store(MessageRequest $request)
    {
        $message = null;

        if ($request->validated('type') === 1) {
            $message = new Message(['content' => $request->validated('content')]);
        } else {
            $filePath = $request->file('content')->store('uploads', 'public');

            $message = new Message(['content' => $filePath]);
        }

        $message->sender()->associate($request->user());
        $message->chat()->associate($request->validated('chat_id'));
        $message->type()->associate($request->validated('type'));
        $message->timestamp = Date::now()->format('H:i');
        $message->save();

        event(new MessageSent($message));

        return Chat::where('id', $message->chat_id)
                    ->with('messages', function ($query) {
                        $query->latest()->limit(1);
                    })
                    ->with('participants')
                    ->first();
    }
}
