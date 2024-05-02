<?php

namespace App\Http\Controllers\Chat;

use App\Models\Message;
use App\Events\Chat\MessageSent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Date;
use App\Http\Requests\Chat\MessageRequest;

class MessageController extends Controller
{
    public function store(MessageRequest $request)
    {
        $message = new Message(['content' => $request->validated('content')]);
        $message->sender()->associate($request->user());
        $message->chat()->associate($request->validated('chat_id'));
        $message->type()->associate($request->validated('type'));
        $message->timestamp = Date::now()->format('H:i');
        $message->save();

        event(new MessageSent($message));

        return response()->noContent();
    }
}
