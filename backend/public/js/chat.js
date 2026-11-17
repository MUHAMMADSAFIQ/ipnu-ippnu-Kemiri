document.addEventListener('DOMContentLoaded', function() {
    scrollToBottom();
});

function scrollToBottom() {
    const chatWindow = document.getElementById('chat-window');
    if (chatWindow) {
        chatWindow.scrollTop = chatWindow.scrollHeight;
    }
}

async function sendMessage(event) {
    event.preventDefault();
    
    const input = document.getElementById('message-input');
    const message = input.value.trim();
    if (!message) return;
    
    const chatWindow = document.getElementById('chat-window');
    const submitBtn = document.querySelector('.chat-form .send-button');
    
    // Disable input while sending
    input.disabled = true;
    submitBtn.disabled = true;
    submitBtn.textContent = '...';
    
    // CSRF Token
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    
    try {
        const response = await fetch('/admin/chat/send', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ message: message })
        });
        
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        
        const data = await response.json();
        
        // Append user message
        appendMessage(data.user);
        scrollToBottom();
        
        // Clear input
        input.value = '';
        
    } catch (error) {
        console.error('Error sending message:', error);
        alert('Gagal mengirim pesan. Silakan coba lagi.');
    } finally {
        // Re-enable input
        input.disabled = false;
        submitBtn.disabled = false;
        submitBtn.textContent = 'Kirim';
        input.focus();
        scrollToBottom();
    }
    
    return false;
}

function appendMessage(msgData) {
    const chatWindow = document.getElementById('chat-window');
    
    const bubble = document.createElement('div');
    const isBot = msgData.author !== 'Admin';
    bubble.className = `chat-bubble ${isBot ? 'bot' : 'user'}`;
    
    const authorStrong = document.createElement('strong');
    authorStrong.textContent = msgData.author + ':';
    
    const textNode = document.createTextNode(' ' + msgData.content);
    
    bubble.appendChild(authorStrong);
    bubble.appendChild(textNode);
    
    chatWindow.appendChild(bubble);
}

// Public Chat version
async function sendPublicMessage(event) {
    event.preventDefault();
    
    const input = document.getElementById('public-message-input');
    const message = input.value.trim();
    if (!message) return;
    
    const chatWindow = document.getElementById('public-chat-window');
    const submitBtn = event.target.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    
    // Disable input while sending
    input.disabled = true;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '...';
    
    // CSRF Token
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    
    try {
        const response = await fetch('/chat/send-public', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ message: message })
        });
        
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        
        const data = await response.json();
        
        // Append user message
        appendPublicMessage(data.user);
        
        // Append bot reply immediately after
        if (data.bot) {
            appendPublicMessage(data.bot);
        }
        
        if (chatWindow) chatWindow.scrollTop = chatWindow.scrollHeight;
        
        // Clear input
        input.value = '';
        
    } catch (error) {
        console.error('Error sending public message:', error);
        alert('Gagal mengirim pesan. Silakan coba lagi.');
    } finally {
        // Re-enable input
        input.disabled = false;
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
        input.focus();
    }
    
    return false;
}

function appendPublicMessage(msgData) {
    const chatWindow = document.getElementById('public-chat-window');
    if (!chatWindow) return;
    
    const bubble = document.createElement('div');
    const isBot = msgData.author === 'Bot' || msgData.author === 'Admin';
    bubble.className = `chat-bubble ${isBot ? 'bot' : 'user'}`;
    
    const authorStrong = document.createElement('strong');
    authorStrong.textContent = msgData.author + ':';
    
    const textNode = document.createTextNode(' ' + msgData.content);
    
    bubble.appendChild(authorStrong);
    bubble.appendChild(textNode);
    
    chatWindow.appendChild(bubble);
}

// Polling for both chats
document.addEventListener('DOMContentLoaded', function() {
    setInterval(async () => {
        try {
            const response = await fetch('/chat/messages-public');
            if (response.ok) {
                const messages = await response.json();
                
                // Update Public Chat
                const publicChat = document.getElementById('public-chat-window');
                if (publicChat && publicChat.parentElement.style.display !== 'none') {
                    const isScrolledToBottom = publicChat.scrollHeight - publicChat.clientHeight <= publicChat.scrollTop + 50;
                    publicChat.innerHTML = '';
                    messages.forEach(msg => appendPublicMessage(msg));
                    if (isScrolledToBottom) publicChat.scrollTop = publicChat.scrollHeight;
                }
                
                // Update Admin Chat
                const adminChat = document.getElementById('chat-window');
                if (adminChat) {
                    const isScrolledToBottom = adminChat.scrollHeight - adminChat.clientHeight <= adminChat.scrollTop + 50;
                    adminChat.innerHTML = '';
                    messages.forEach(msg => {
                        const bubble = document.createElement('div');
                        const isBot = msg.author !== 'Admin';
                        bubble.className = `chat-bubble ${isBot ? 'bot' : 'user'}`;
                        const authorStrong = document.createElement('strong');
                        authorStrong.textContent = msg.author + ':';
                        const textNode = document.createTextNode(' ' + msg.content);
                        bubble.appendChild(authorStrong);
                        bubble.appendChild(textNode);
                        adminChat.appendChild(bubble);
                    });
                    if (isScrolledToBottom) adminChat.scrollTop = adminChat.scrollHeight;
                }
            }
        } catch (e) {
            console.error('Polling error', e);
        }
    }, 3000);
});
