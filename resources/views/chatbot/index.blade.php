<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Assistant CSC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-robot me-2"></i>
                            Assistant Virtual CSC
                        </h4>
                        <small>Posez vos questions sur le Computer Science Club</small>
                    </div>
                    
                    <div class="card-body p-0">
                        <!-- Zone de chat -->
                        <div id="chatContainer" class="chat-container" style="height: 400px; overflow-y: auto; padding: 20px; background-color: #f8f9fa;">
                            <div class="chat-message bot-message mb-3">
                                <div class="d-flex">
                                    <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                        <i class="fas fa-robot"></i>
                                    </div>
                                    <div class="message-content bg-white p-3 rounded shadow-sm">
                                        Salut ! Je suis l'assistant virtuel du Computer Science Club. Comment puis-je vous aider aujourd'hui ? 😊
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Zone de saisie -->
                        <div class="card-footer bg-white border-top">
                            <form id="chatForm" class="d-flex">
                                <input type="text" id="messageInput" class="form-control me-2" placeholder="Tapez votre message..." required>
                                <button type="submit" id="sendButton" class="btn btn-primary">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Indicateur de frappe -->
                    <div id="typingIndicator" class="px-4 pb-2" style="display: none;">
                        <small class="text-muted">
                            <i class="fas fa-circle-notch fa-spin me-1"></i>
                            L'assistant écrit...
                        </small>
                    </div>
                </div>
                
                <!-- Suggestions rapides -->
                <div class="row mt-3">
                    <div class="col-12">
                        <small class="text-muted">Questions fréquentes :</small>
                        <div class="mt-2">
                            <button class="btn btn-outline-primary btn-sm me-2 mb-2 quick-question" data-question="Comment rejoindre le club ?">
                                Comment rejoindre ?
                            </button>
                            <button class="btn btn-outline-primary btn-sm me-2 mb-2 quick-question" data-question="Quelles sont les activités du club ?">
                                Nos activités
                            </button>
                            <button class="btn btn-outline-primary btn-sm me-2 mb-2 quick-question" data-question="Qui sont les responsables du club ?">
                                Responsables
                            </button>
                            <button class="btn btn-outline-primary btn-sm me-2 mb-2 quick-question" data-question="Comment vous contacter ?">
                                Contact
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .chat-container {
            scroll-behavior: smooth;
        }

        .bot-message .message-content {
            max-width: 80%;
            border-left: 4px solid #007bff;
        }

        .user-message {
            justify-content: flex-end;
        }

        .user-message .message-content {
            background-color: #007bff !important;
            color: white;
            max-width: 80%;
        }

        .user-message .avatar {
            background-color: #6c757d;
            order: 2;
            margin-left: 12px;
            margin-right: 0;
        }

        .quick-question:hover {
            cursor: pointer;
        }

        .avatar {
            min-width: 40px;
            font-size: 14px;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chatForm = document.getElementById('chatForm');
            const messageInput = document.getElementById('messageInput');
            const sendButton = document.getElementById('sendButton');
            const chatContainer = document.getElementById('chatContainer');
            const typingIndicator = document.getElementById('typingIndicator');
            
            // Gestion des questions rapides
            document.querySelectorAll('.quick-question').forEach(button => {
                button.addEventListener('click', function() {
                    const question = this.dataset.question;
                    messageInput.value = question;
                    sendMessage(question);
                });
            });
            
            // Gestion du formulaire
            chatForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const message = messageInput.value.trim();
                if (message) {
                    sendMessage(message);
                }
            });
            
            function sendMessage(message) {
                // Ajouter le message de l'utilisateur
                addUserMessage(message);
                
                // Vider le champ de saisie
                messageInput.value = '';
                
                // Désactiver le bouton et afficher l'indicateur
                sendButton.disabled = true;
                typingIndicator.style.display = 'block';
                
                // Envoyer la requête
                fetch('/chatbot/send', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        message: message
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Réponse reçue:', data);
                    if (data.success) {
                        addBotMessage(data.message);
                    } else {
                        addBotMessage('Désolé, une erreur est survenue: ' + (data.message || 'Erreur inconnue'));
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    addBotMessage('Désolé, une erreur de connexion est survenue. Veuillez réessayer.');
                })
                .finally(() => {
                    // Réactiver le bouton et masquer l'indicateur
                    sendButton.disabled = false;
                    typingIndicator.style.display = 'none';
                    messageInput.focus();
                });
            }
            
            function addUserMessage(message) {
                const messageDiv = document.createElement('div');
                messageDiv.className = 'chat-message user-message mb-3';
                messageDiv.innerHTML = `
                    <div class="d-flex">
                        <div class="avatar bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="message-content bg-primary text-white p-3 rounded shadow-sm">
                            ${escapeHtml(message)}
                        </div>
                    </div>
                `;
                chatContainer.appendChild(messageDiv);
                scrollToBottom();
            }
            
            function addBotMessage(message) {
                const messageDiv = document.createElement('div');
                messageDiv.className = 'chat-message bot-message mb-3';
                messageDiv.innerHTML = `
                    <div class="d-flex">
                        <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                            <i class="fas fa-robot"></i>
                        </div>
                        <div class="message-content bg-white p-3 rounded shadow-sm">
                            ${escapeHtml(message).replace(/\n/g, '<br>')}
                        </div>
                    </div>
                `;
                chatContainer.appendChild(messageDiv);
                scrollToBottom();
            }
            
            function scrollToBottom() {
                chatContainer.scrollTop = chatContainer.scrollHeight;
            }
            
            function escapeHtml(text) {
                const div = document.createElement('div');
                div.textContent = text;
                return div.innerHTML;
            }
            
            // Focus sur le champ de saisie au chargement
            messageInput.focus();
        });
    </script>
</body>
</html>