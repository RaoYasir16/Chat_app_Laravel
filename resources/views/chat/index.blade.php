<!DOCTYPE html>
<html>

<head>
    <title>Chat App</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            font-family: Arial;
            margin: 0;
        }

        .container {
            display: flex;
            height: 100vh;
        }

        .users {
            width: 30%;
            border-right: 1px solid #ccc;
            overflow-y: auto;
        }

        .chat-box {
            width: 70%;
            display: flex;
            flex-direction: column;
        }

        .messages {
            flex: 1;
            padding: 10px;
            overflow-y: auto;
            background: #f5f5f5;
        }

        .input-box {
            display: flex;
            padding: 10px;
        }

        .input-box input {
            flex: 1;
            padding: 10px;
        }
    </style>
</head>

<body>

    <div class="container">

        <!-- USERS -->
        <div class="users">
            @foreach($users as $user)
            <div onclick="loadChat({{ $user->id }})"
                style="padding:10px; cursor:pointer; border-bottom:1px solid #eee;">
                {{ $user->name }}
            </div>
            @endforeach
        </div>

        <!-- CHAT -->
        <div class="chat-box">

            <div class="messages" id="messages"></div>

            <div class="input-box">
                <input type="text" id="message" placeholder="Type message...">
                <button onclick="sendMessage()">Send</button>
            </div>

        </div>

    </div>

    <script>
        // CURRENT USER ID (IMPORTANT FIX)
        let selectedUserId = null;
        const authUserId = {{ auth()->id() }};

        // Load chat history
        function loadChat(userId) {

            selectedUserId = userId;
            window.selectedUserId = userId;

            fetch(`/messages/${userId}`)
                .then(res => res.json())
                .then(data => {

                    let html = '';

                    data.forEach(msg => {

                        let senderName = msg.sender.name;
                        let sender = (msg.sender_id == authUserId) ? 'Me' : senderName;

                        html += `
                <div style="margin-bottom:5px;">
                    <b>${sender}:</b> ${msg.message}
                </div>
            `;
                    });

                    document.getElementById('messages').innerHTML = html;
                });
        }

        // Send message
        function sendMessage() {

            let message = document.getElementById('message').value;

            if (!selectedUserId) {
                alert("Please select a user first!");
                return;
            }

            let msgBox = document.getElementById('messages');

            // ✅ 1. INSTANTLY SHOW MESSAGE (SENDER SIDE)
            msgBox.innerHTML += `
         <div style="margin-bottom:5px;">
         <b>Me:</b> ${message}
          </div>
         `;

            // auto scroll
            msgBox.scrollTop = msgBox.scrollHeight;

            // ✅ 2. SEND TO SERVER
            fetch('/send-message', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    receiver_id: selectedUserId,
                    message: message
                })
            });

            document.getElementById('message').value = '';
        }
    </script>

</body>

</html>
@vite(['resources/js/app.js'])