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
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
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
        
        // Append bot reply after a small delay for natural feel
        setTimeout(() => {
            appendMessage(data.bot);
            scrollToBottom();
        }, 500);
        
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
    const isBot = msgData.author === 'Bot';
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
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
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
        
        // Append bot reply after a small delay
        setTimeout(() => {
            appendPublicMessage(data.bot);
            if (chatWindow) chatWindow.scrollTop = chatWindow.scrollHeight;
        }, 500);
        
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
        if (chatWindow) chatWindow.scrollTop = chatWindow.scrollHeight;
    }
    
    return false;
}

function appendPublicMessage(msgData) {
    const chatWindow = document.getElementById('public-chat-window');
    if (!chatWindow) return;
    
    const bubble = document.createElement('div');
    const isBot = msgData.author === 'Bot';
    bubble.className = `chat-bubble ${isBot ? 'bot' : 'user'}`;
    
    const authorStrong = document.createElement('strong');
    authorStrong.textContent = msgData.author + ':';
    
    const textNode = document.createTextNode(' ' + msgData.content);
    
    bubble.appendChild(authorStrong);
    bubble.appendChild(textNode);
    
    chatWindow.appendChild(bubble);
}
