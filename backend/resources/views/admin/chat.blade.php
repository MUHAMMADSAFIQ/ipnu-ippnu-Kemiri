<?php

/**
 * Chat view for admin dashboard.
 * Uses vanilla CSS for a premium glass‑morphism look.
 */
?>
@extends('admin.layout')

@section('content')
<div class="chat-container">
    <h2 class="chat-title">Admin Chatbot</h2>
    <div id="chat-window" class="chat-window">
        @foreach($messages as $msg)
            <div class="chat-bubble {{ $msg->author === 'Bot' ? 'bot' : 'user' }}">
                <strong>{{ $msg->author }}:</strong> {{ $msg->content }}
            </div>
        @endforeach
    </div>
    <form id="chat-form" class="chat-form" onsubmit="return sendMessage(event);">
        <input type="text" id="message-input" name="message" placeholder="Ketik pesan..." required autocomplete="off" />
        <button type="submit" class="send-button">Kirim</button>
    </form>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/chat.css') }}" />
@endpush

@push('scripts')
<script src="{{ asset('js/chat.js') }}"></script>
@endpush
