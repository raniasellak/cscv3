<!DOCTYPE html>
<html lang="fr">
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {{-- NAVBAR USER, STYLES, etc. --}}
</head>
<body>

    @yield('content')
   <a href="{{ route('about') }}">À propos</a>
 <style>
#chatbot-container {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 300px;
    background: white;
    border: 1px solid #ccc;
    border-radius: 10px;
    overflow: hidden;
    font-family: Arial, sans-serif;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

#chatbot-messages {
    height: 200px;
    overflow-y: auto;
    padding: 10px;
    background: #f9f9f9;
}

#chatbot-input {
    display: flex;
    border-top: 1px solid #ccc;
}

#chatbot-input input {
    flex: 1;
    border: none;
    padding: 10px;
}

#chatbot-input button {
    background: #004080;
    color: white;
    border: none;
    padding: 10px 15px;
    cursor: pointer;
}
</style>

<div id="chatbot-container">
    <div id="chatbot-messages">
        <div><strong>Bot:</strong> Bonjour ! Pose-moi une question sur le club.</div>
    </div>
    <div id="chatbot-input">
        <input type="text" id="chatbot-question" placeholder="Écris ta question...">
        <button onclick="sendMessage()">Envoyer</button>
    </div>
</div>

<script>
function sendMessage() {
    const input = document.getElementById('chatbot-question');
    const message = input.value;
    if (!message) return;

    const messages = document.getElementById('chatbot-messages');
    messages.innerHTML += `<div><strong>Vous:</strong> ${message}</div>`;

    fetch('/chatbot', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ message: message })
    })
    .then(res => res.json())
    .then(data => {
        messages.innerHTML += `<div><strong>Bot:</strong> ${data.reply}</div>`;
        messages.scrollTop = messages.scrollHeight;
        input.value = '';
    });
}
</script>


</body>
</html>
