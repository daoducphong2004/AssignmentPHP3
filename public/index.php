<?php

use App\Services\FirebaseService;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;


define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
|
| If the application is in maintenance / demo mode via the "down" command
| we will load this file so that any pre-rendered content can be shown
| instead of starting the framework, which could cause an exception.
|
*/

if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| the application's HTTP kernel. Then, we will send the response back
| to this client's browser, allowing them to enjoy our application.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);
?>
<script type="module">
    import { initializeApp } from "https://www.gstatic.com/firebasejs/9.0.2/firebase-app.js";
    import { getDatabase, ref, push, onValue } from "https://www.gstatic.com/firebasejs/9.0.2/firebase-database.js";

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

    // Function to send message
  window.sendMessage =   function (chatRoomId, message) {
        const messagesRef = ref(database, 'chatrooms/' + chatRoomId + '/messages');
        push(messagesRef, {
            text: message,
            timestamp: new Date().getTime()  // Add timestamp for sorting
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
                messageElement.innerText = message.text;
                chatDiv.appendChild(messageElement);
            }
        }
    }

    // Listen for new messages
    function listenForMessages(chatRoomId) {
        const messagesRef = ref(database, 'chatrooms/' + chatRoomId + '/messages');
        onValue(messagesRef, (snapshot) => {
            const messages = snapshot.val();
            displayMessages(messages);
        });
    }

    // Initialize chat room
    listenForMessages('chatRoom1');
</script>
