@extends('layout.app')
@section('title', 'Chat')

@section('content')
    <select class="form-group" name="chatroomlist" id="chatroomlist">
        <option value="1">Phòng chat số 1</option>
        <option value="2">Phòng chat số 2</option>
        <option value="3">Phòng chat số 3</option>
        <option value="4">Phòng chat số 4</option>
    </select>
    <div id="chat">
        <div id="chatMessages"></div>
        <input type="text" id="messageInput" placeholder="Nhập tin nhắn">
        <button onclick="sendMessage(document.getElementById('chatroomlist').value, document.getElementById('messageInput').value)">Gửi</button>
    </div>
@endsection

@push('scripts')
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/9.0.2/firebase-app.js";
        import { getDatabase, ref, push, onValue, off } from "https://www.gstatic.com/firebasejs/9.0.2/firebase-database.js";

        const firebaseConfig = {
            apiKey: "AIzaSyBedOWfH-dOb2KDeiFEBBRFYFQU9gY04CU",
            authDomain: "assignmentphp3.firebaseapp.com",
            databaseURL: "https://assignmentphp3-default-rtdb.asia-southeast1.firebasedatabase.app",
            projectId: "assignmentphp3",
            storageBucket: "assignmentphp3.appspot.com",
            messagingSenderId: "304958321074",
            appId: "1:304958321074:web:c266563f3219ef123334ab"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const database = getDatabase(app);
        let currentChatRoomRef = null;

        // Function to send message
        window.sendMessage = function(toUserId, message) {
            const messagesRef = ref(database, 'chatrooms/' + toUserId + '/messages');
            push(messagesRef, {
                from_user_id: '{{ Auth::id() }}',
                to_user_id: toUserId,
                content: message,
                timestamp: new Date().getTime() // Add timestamp for sorting
            });
            document.getElementById('messageInput').value = ''; // Clear input after sending
        }

        // Function to display messages
        function displayMessages(messages) {
            const chatDiv = document.getElementById('chatMessages');
            chatDiv.innerHTML = ''; // Clear previous messages
            for (let key in messages) {
                if (messages.hasOwnProperty(key)) {
                    const message = messages[key];
                    const messageElement = document.createElement('div');
                    messageElement.innerText = message.content;
                    chatDiv.appendChild(messageElement);
                }
            }
        }

        // Function to listen for messages in a specific chat room
        function listenForMessages(chatRoomId) {
            currentChatRoomRef = ref(database, 'chatrooms/' + chatRoomId + '/messages');
            onValue(currentChatRoomRef, (snapshot) => {
                const messages = snapshot.val();
                displayMessages(messages);
            });
        }

        // Function to switch chat rooms
        function switchChatRoom(chatRoomId) {
            // Unsubscribe from current chat room messages
            if (currentChatRoomRef) {
                off(currentChatRoomRef);
            }
            // Clear chat messages div
            const chatDiv = document.getElementById('chatMessages');
            chatDiv.innerHTML = '';

            // Start listening for messages in the new chat room
            listenForMessages(chatRoomId);
        }

        // Initial chat room setup
        switchChatRoom('1');

        document.getElementById('chatroomlist').addEventListener('change', function() {
            switchChatRoom(this.value);
        });
    </script>
@endpush
