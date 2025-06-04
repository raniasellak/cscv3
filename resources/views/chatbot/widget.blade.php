<!-- Widget Chatbot à intégrer dans vos pages -->
<!-- Placez ce code où vous voulez que le bouton du chatbot apparaisse -->

<div id="chatbot-widget">
    <!-- Bouton flottant -->
    <div id="chatbot-toggle" class="chatbot-toggle">
        <i class="fas fa-comments"></i>
    </div>
    
    <!-- Fenêtre de chat -->
    <div id="chatbot-window" class="chatbot-window" style="display: none;">
        <div class="chatbot-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-0">Assistant CSC</h6>
                    <small>En ligne</small>
                </div>
                <button id="chatbot-close" class="btn btn-sm">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        
        <div id="chatbot-messages" class="chatbot-messages">
            <div class="bot-message">
                <div class="message-bubble">
                    Salut ! Comment puis-je vous aider concernant le CSC ? 😊
                </div>
            </div>
        </div>
        
        <div class="chatbot-input">
            <div class="input-group">
                <input type="text" id="chatbot-input" class="form-control" placeholder="Tapez votre message...">
                <button id="chatbot-send" class="btn btn-primary">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
        
        <div id="chatbot-typing" class="chatbot-typing" style="display: none;">
            <small>L'assistant écrit...</small>
        </div>
    </div>
</div>

<style>
.chatbot-toggle {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #ff8c00, #e07600);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 4px 20px rgba(255,140,0,0.3);
    transition: all 0.3s ease;
    z-index: 1000;
    color: white;
    font-size: 24px;
}

.chatbot-toggle:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 25px rgba(255,140,0,0.4);
}

.chatbot-window {
    position: fixed;
    bottom: 100px;
    right: 20px;
    width: 350px;
    height: 500px;
    background: white;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    z-index: 1001;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.chatbot-header {
    background: linear-gradient(135deg, #333333, #1a1a1a);
    color: white;
    padding: 15px;
    border-radius: 15px 15px 0 0;
}

.chatbot-messages {
    flex: 1;
    overflow-y: auto;
    padding: 15px;
    background: #f8f9fa;
}

.bot-message, .user-message {
    margin-bottom: 15px;
}

.bot-message {
    text-align: left;
}

.user-message {
    text-align: right;
}

.message-bubble {
    display: inline-block;
    padding: 10px 15px;
    border-radius: 15px;
    max-width: 80%;
    word-wrap: break-word;
}

.bot-message .message-bubble {
    background: white;
    border: 1px solid #e9ecef;
    border-left: 4px solid #ff8c00;
}

.user-message .message-bubble {
    background: #ff8c00;
    color: white;
}

.chatbot-input {
    padding: 15px;
    background: white;
    border-top: 1px solid #e9ecef;
}

.chatbot-input .btn-primary {
    background: #ff8c00;
    border-color: #ff8c00;
}

.chatbot-input .btn-primary:hover {
    background: #e07600;
    border-color: #e07600;
}

.chatbot-typing {
    padding: 5px 15px;
    background: white;
    border-top: 1px solid #e9ecef;
    color: #6c757d;
}

#chatbot-close {
    background: none;
    border: none;
    color: white;
    font-size: 18px;
}

#chatbot-close:hover {
    background: rgba(255,255,255,0.1);
    border-radius: 50%;
}

/* Responsive */
@media (max-width: 768px) {
    .chatbot-window {
        width: calc(100% - 40px);
        right: 20px;
        left: 20px;
        height: 400px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggle = document.getElementById('chatbot-toggle');
    const window = document.getElementById('chatbot-window');
    const close = document.getElementById('chatbot-close');
    const input = document.getElementById('chatbot-input');
    const send = document.getElementById('chatbot-send');
    const messages = document.getElementById('chatbot-messages');
    const typing = document.getElementById('chatbot-typing');
    
    let isOpen = false;
    
    // Ouvrir/fermer le chatbot
    toggle.addEventListener('click', function() {
        if (isOpen) {
            window.style.display = 'none';
            isOpen = false;
        } else {
            window.style.display = 'flex';
            isOpen = true;
            input.focus();
        }
    });
    
    close.addEventListener('click', function() {
        window.style.display = 'none';
        isOpen = false;
    });
    
    // Envoyer message
    function sendMessage() {
        const message = input.value.trim();
        if (!message) return;
        
        // Ajouter message utilisateur
        addMessage(message, 'user');
        input.value = '';
        
        // Afficher indicateur de frappe
        typing.style.display = 'block';
        send.disabled = true;
        
        // Envoyer à l'API
        fetch('{{ route("chatbot.send") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content || '{{ csrf_token() }}'
            },
            body: JSON.stringify({ message: message })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                addMessage(data.message, 'bot');
            } else {
                addMessage('Désolé, une erreur est survenue.', 'bot');
            }
        })
        .catch(error => {
            addMessage('Erreur de connexion. Veuillez réessayer.', 'bot');
        })
        .finally(() => {
            typing.style.display = 'none';
            send.disabled = false;
        });
    }
    
    function addMessage(text, sender) {
        const messageDiv = document.createElement('div');
        messageDiv.className = sender + '-message';
        messageDiv.innerHTML = `
            <div class="message-bubble">
                ${escapeHtml(text).replace(/\n/g, '<br>')}
            </div>
        `;
        messages.appendChild(messageDiv);
        messages.scrollTop = messages.scrollHeight;
    }
    
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
    
    // Events
    send.addEventListener('click', sendMessage);
    input.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });
});
</script>