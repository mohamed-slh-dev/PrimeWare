<?php

namespace App\Http\Controllers;

use App\Events\MessageSentEvent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{

    
    public function index()
    {
        return Message::with('user')->get();
    }

    public function store(Request $request)
    {
        $user = User::find(session()->get('user_id'));

        $message = $user->messages()->create([
            'message' => $request->input('message')
        ]);


        // send event to listeners
        broadcast(new MessageSentEvent($message, $user))->toOthers();


        return [
            'message' => $message,
            'user' => $user,
        ];
    }

}
