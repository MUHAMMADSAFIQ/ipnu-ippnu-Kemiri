<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Show the chat interface.
     */
    public function index()
    {
        // Load latest 50 messages
        $messages = ChatMessage::orderBy('created_at', 'desc')->take(50)->get()->reverse();
        return view('admin.chat', compact('messages'));
    }

    /**
     * Store a user message and generate a simple bot reply.
     */
    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $user = Auth::user();
        $author = $user ? $user->name : 'Admin';

        // Store user message
        $userMessage = ChatMessage::create([
            'author' => $author,
            'content' => $request->message,
        ]);

        // Simple placeholder bot reply (echo back)
        $botReply = "Bot: " . $request->message;
        $botMessage = ChatMessage::create([
            'author' => 'Bot',
            'content' => $botReply,
        ]);

        return response()->json([
            'user' => $userMessage,
            'bot' => $botMessage,
        ]);
    }
}
