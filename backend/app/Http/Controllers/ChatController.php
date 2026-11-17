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
        $messages = ChatMessage::orderBy('id', 'desc')->take(50)->get()->reverse();
        return view('admin.chat', compact('messages'));
    }

    /**
     * Store a user message and generate an intelligent AI bot reply.
     */
    public function send(Request $request, \App\Services\ChatbotService $chatbotService)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $author = Auth::check() ? Auth::user()->name : 'Admin';

        // Store user message
        $userMessage = ChatMessage::create([
            'author' => $author,
            'content' => $request->message,
        ]);

        $botReply = $chatbotService->reply($request->message);

        $botMessage = ChatMessage::create([
            'author' => 'AI Bot',
            'content' => $botReply,
        ]);

        return response()->json([
            'user' => $userMessage,
            'bot'  => $botMessage,
        ]);
    }
}
