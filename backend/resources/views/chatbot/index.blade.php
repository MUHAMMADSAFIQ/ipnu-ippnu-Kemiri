@extends('layouts.portal')

@section('title', 'AI Chatbot Asisten Pelajar — PAC IPNU IPPNU Kemiri')

@section('content')
<div class="na-wrapper">
    <div class="na-header" style="background: linear-gradient(135deg, #0f172a, var(--primary-dark)); color: white; padding: 20px 28px; border-radius: 16px 16px 0 0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
        <div style="display: flex; align-items: center; gap: 14px;">
            <div style="width: 46px; height: 46px; border-radius: 50%; background: linear-gradient(135deg, var(--accent), var(--primary-light)); display: flex; align-items: center; justify-content: center; color: #0f172a; font-size: 1.4rem; box-shadow: 0 4px 12px rgba(0,0,0,0.3);">
                <i class="fa-solid fa-robot"></i>
            </div>
            <div>
                <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                    <h1 style="font-family: 'Outfit', sans-serif; font-size: 1.35rem; font-weight: 800; margin: 0; color: white;">ASISTEN AI PELAJAR NU</h1>
                    <span style="background: #22c55e; color: #052e16; font-size: 0.65rem; font-weight: 800; padding: 2px 8px; border-radius: 20px; text-transform: uppercase;">ONLINE</span>
                    <span style="background: linear-gradient(135deg, #1e40af, #2563eb); color: #ffffff; font-size: 0.65rem; font-weight: 800; padding: 2px 8px; border-radius: 20px; display: inline-flex; align-items: center; gap: 4px;">
                        <i class="fa-solid fa-wand-magic-sparkles"></i> Powered by Google Gemini
                    </span>
                </div>
                <p style="margin: 2px 0 0 0; font-size: 0.8rem; color: rgba(255,255,255,0.75);">Asisten Cerdas Virtual PAC IPNU IPPNU Kecamatan Kemiri</p>
            </div>
        </div>
        <a href="{{ url('/') }}" style="color: white; background: rgba(255,255,255,0.12); padding: 8px 16px; border-radius: 8px; text-decoration: none; font-size: 0.82rem; font-weight: 700;">
            <i class="fa-solid fa-arrow-left"></i> Beranda
        </a>
    </div>

    <div style="background: white; border-radius: 0 0 16px 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.04); display: flex; flex-direction: column; height: 680px; max-height: 80vh; overflow: hidden;">
        <!-- Quick Prompt Chips -->
        <div style="padding: 12px 20px; background: #f8fafc; border-bottom: 1px solid #e2e8f0; display: flex; gap: 8px; overflow-x: auto; scrollbar-width: none;">
            <span style="font-size: 0.75rem; font-weight: 700; color: #64748b; display: flex; align-items: center; white-space: nowrap;">Tanya Cepat:</span>
            <button onclick="sendQuickPrompt('Bagaimana cara bergabung dengan IPNU IPPNU Kemiri?')" style="background: white; border: 1px solid #cbd5e1; border-radius: 16px; padding: 4px 12px; font-size: 0.78rem; font-weight: 600; color: #334155; cursor: pointer; white-space: nowrap; transition: all 0.2s;">
                📝 Cara Gabung / Makesta
            </button>
            <button onclick="sendQuickPrompt('Apa visi dan misi PAC IPNU IPPNU Kemiri?')" style="background: white; border: 1px solid #cbd5e1; border-radius: 16px; padding: 4px 12px; font-size: 0.78rem; font-weight: 600; color: #334155; cursor: pointer; white-space: nowrap; transition: all 0.2s;">
                🎯 Visi & Misi PAC
            </button>
            <button onclick="sendQuickPrompt('Di mana alamat sekretariat PAC IPNU IPPNU Kemiri?')" style="background: white; border: 1px solid #cbd5e1; border-radius: 16px; padding: 4px 12px; font-size: 0.78rem; font-weight: 600; color: #334155; cursor: pointer; white-space: nowrap; transition: all 0.2s;">
                📍 Alamat Sekretariat
            </button>
            <button onclick="sendQuickPrompt('Apa saja agenda kegiatan atau program kerja terdekat?')" style="background: white; border: 1px solid #cbd5e1; border-radius: 16px; padding: 4px 12px; font-size: 0.78rem; font-weight: 600; color: #334155; cursor: pointer; white-space: nowrap; transition: all 0.2s;">
                📅 Agenda Kegiatan
            </button>
            <button onclick="sendQuickPrompt('Siapa ketua PAC IPNU dan IPPNU Kemiri saat ini?')" style="background: white; border: 1px solid #cbd5e1; border-radius: 16px; padding: 4px 12px; font-size: 0.78rem; font-weight: 600; color: #334155; cursor: pointer; white-space: nowrap; transition: all 0.2s;">
                👥 Nahkoda / Ketua PAC
            </button>
        </div>

        <!-- Chat Conversation Messages -->
        <div id="aiChatWindow" style="flex: 1; padding: 24px; overflow-y: auto; display: flex; flex-direction: column; gap: 16px; background: #fdfdfd;">
            <!-- Welcome message from AI -->
            <div style="display: flex; gap: 12px; align-items: flex-start; max-width: 85%;">
                <div style="width: 38px; height: 38px; border-radius: 50%; background: linear-gradient(135deg, var(--accent), var(--primary)); display: flex; align-items: center; justify-content: center; color: #000; font-size: 1.1rem; flex-shrink: 0; box-shadow: 0 2px 6px rgba(0,0,0,0.15);">
                    <i class="fa-solid fa-robot"></i>
                </div>
                <div style="background: #f1f5f9; color: #1e293b; padding: 14px 18px; border-radius: 4px 16px 16px 16px; font-size: 0.92rem; line-height: 1.6; box-shadow: 0 1px 3px rgba(0,0,0,0.05); border: 1px solid #e2e8f0;">
                    <strong>Assalamu'alaikum Rekan dan Rekanita! 👋</strong><br>
                    Saya adalah <strong>Asisten AI PAC IPNU IPPNU Kemiri</strong>. Ada yang bisa saya bantu seputar profil organisasi, pendaftaran anggota baru (Makesta), program kerja, alamat sekretariat, atau berita kegiatan terkini?
                </div>
            </div>
        </div>

        <!-- Input Box -->
        <div style="padding: 16px 20px; background: white; border-top: 1px solid #e2e8f0;">
            <form id="aiChatForm" onsubmit="return handleAiChatSubmit(event)" style="display: flex; gap: 10px; align-items: center;">
                <input type="text" id="aiUserInput" placeholder="Ketik pertanyaan Anda di sini (misal: syarat gabung IPNU, jadwal sholat, info makesta)..." required autocomplete="off" style="flex: 1; padding: 14px 20px; border: 1px solid #cbd5e1; border-radius: 30px; font-family: inherit; font-size: 0.95rem; outline: none; transition: border-color 0.2s;">
                <button type="submit" id="aiSubmitBtn" style="background: var(--primary); color: white; border: none; padding: 14px 26px; border-radius: 30px; font-weight: 700; cursor: pointer; display: flex; align-items: center; gap: 8px; font-family: 'Outfit'; font-size: 0.95rem; transition: background 0.2s; box-shadow: 0 4px 12px rgba(21,128,61,0.3);">
                    <span>Kirim</span> <i class="fa-solid fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function sendQuickPrompt(text) {
    document.getElementById('aiUserInput').value = text;
    document.getElementById('aiChatForm').dispatchEvent(new Event('submit'));
}

async function handleAiChatSubmit(e) {
    e.preventDefault();
    const input = document.getElementById('aiUserInput');
    const msg = input.value.trim();
    if (!msg) return;

    const chatWindow = document.getElementById('aiChatWindow');
    const submitBtn = document.getElementById('aiSubmitBtn');

    // 1. Append User Bubble
    const userDiv = document.createElement('div');
    userDiv.style.display = 'flex';
    userDiv.style.justifyContent = 'flex-end';
    userDiv.style.marginLeft = 'auto';
    userDiv.style.maxWidth = '85%';
    userDiv.innerHTML = `
        <div style="background: var(--primary); color: white; padding: 12px 18px; border-radius: 16px 4px 16px 16px; font-size: 0.92rem; line-height: 1.5; box-shadow: 0 2px 8px rgba(21,128,61,0.25);">
            ${escapeHtml(msg)}
        </div>
    `;
    chatWindow.appendChild(userDiv);
    input.value = '';
    chatWindow.scrollTop = chatWindow.scrollHeight;

    // 2. Typing indicator
    const typingDiv = document.createElement('div');
    typingDiv.id = 'aiTypingIndicator';
    typingDiv.style.display = 'flex';
    typingDiv.style.gap = '12px';
    typingDiv.style.alignItems = 'center';
    typingDiv.innerHTML = `
        <div style="width: 36px; height: 36px; border-radius: 50%; background: #e2e8f0; display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 1rem;">
            <i class="fa-solid fa-robot"></i>
        </div>
        <div style="background: #f1f5f9; padding: 10px 16px; border-radius: 16px; font-size: 0.85rem; color: #64748b;">
            <i class="fa-solid fa-circle-notch fa-spin"></i> AI sedang mengetik jawaban...
        </div>
    `;
    chatWindow.appendChild(typingDiv);
    chatWindow.scrollTop = chatWindow.scrollHeight;

    input.disabled = true;
    submitBtn.disabled = true;

    try {
        const tokenMeta = document.querySelector('meta[name="csrf-token"]');
        const token = tokenMeta ? tokenMeta.getAttribute('content') : '{{ csrf_token() }}';

        const res = await fetch('/chat/send-public', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ message: msg })
        });

        if (!res.ok) {
            const errData = await res.json().catch(() => null);
            throw new Error(errData?.message || 'Server error (' + res.status + ')');
        }

        const data = await res.json();
        const indicator = document.getElementById('aiTypingIndicator');
        if (indicator) indicator.remove();

        const replyContent = data.bot ? data.bot.content : (data.reply || 'Mohon maaf, terjadi kendala saat merespon.');

        // Append Bot Bubble
        const botDiv = document.createElement('div');
        botDiv.style.display = 'flex';
        botDiv.style.gap = '12px';
        botDiv.style.alignItems = 'flex-start';
        botDiv.style.maxWidth = '85%';
        botDiv.innerHTML = `
            <div style="width: 38px; height: 38px; border-radius: 50%; background: linear-gradient(135deg, var(--accent), var(--primary)); display: flex; align-items: center; justify-content: center; color: #000; font-size: 1.1rem; flex-shrink: 0; box-shadow: 0 2px 6px rgba(0,0,0,0.15);">
                <i class="fa-solid fa-robot"></i>
            </div>
            <div style="background: #f1f5f9; color: #1e293b; padding: 14px 18px; border-radius: 4px 16px 16px 16px; font-size: 0.92rem; line-height: 1.6; box-shadow: 0 1px 3px rgba(0,0,0,0.05); border: 1px solid #e2e8f0;">
                ${replyContent}
            </div>
        `;
        chatWindow.appendChild(botDiv);
    } catch (err) {
        console.error(err);
        const indicator = document.getElementById('aiTypingIndicator');
        if (indicator) indicator.remove();

        const errDiv = document.createElement('div');
        errDiv.style.padding = '10px 16px';
        errDiv.style.background = '#fef2f2';
        errDiv.style.color = '#b91c1c';
        errDiv.style.borderRadius = '8px';
        errDiv.style.fontSize = '0.85rem';
        errDiv.textContent = 'Gagal terhubung dengan server AI: ' + (err.message || 'Silakan coba lagi.');
        chatWindow.appendChild(errDiv);
    } finally {
        input.disabled = false;
        submitBtn.disabled = false;
        input.focus();
        chatWindow.scrollTop = chatWindow.scrollHeight;
    }
}

function escapeHtml(text) {
    return text.replace(/[&<>"']/g, function(m) {
        return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' }[m];
    });
}
</script>
@endsection
