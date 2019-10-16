<?php

namespace App\Http\Controllers;

use App\Events\MessagePosted;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

class MessageController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getChat()
    {
        return view('admin.chat.chat');
    }

    public function index()
    {
        return Message::with('user')->get();
    }

    public function store()
    {
        $user = Auth::user();
        //$message = Message::create(['message' => request()->get('message'), 'user_id' => $user->id]);
        $message = $user->messages()->create(['message' => request()->get('message')]);
        broadcast(new MessagePosted($message, $user))->toOthers();
        //return ['status' => 'OK'];
        return $message;
    }
}
