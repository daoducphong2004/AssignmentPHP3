<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class FirebaseService
{
    protected $database;

    public function __construct()
    {
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/path/to/serviceAccountKey.json');

        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri(config('firebase.database_url'));

        $this->database = $firebase->createDatabase();
    }

    public function sendMessage($toUserId, $message)
    {
        $fromUserId = Auth::id();

        $this->database
            ->getReference('chatrooms')
            ->push([
                'from_user_id' => $fromUserId,
                'to_user_id' => $toUserId,
                'content' => $message,
                'timestamp' => time()  // Thêm timestamp nếu cần
            ]);
    }

    public function getMessages($chatRoomId)
    {
        return $this->database
            ->getReference('chatrooms/' . $chatRoomId . '/messages')
            ->getValue();
    }
}
