<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Services\UserSession;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Ambil daftar kontak chat (guru untuk siswa, siswa untuk guru)
     */
    public function contacts()
    {
        $session = UserSession::getInstance();
        $user = $session->getUser();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $userId = $user->id_user;
        $role = $user->role;

        $targetRole = ($role === 'siswa') ? 'guru' : 'siswa';

        $contacts = User::where('role', $targetRole)->get()->map(function ($contact) use ($userId) {
            $lastMessage = Message::where(function ($q) use ($userId, $contact) {
                    $q->where('sender_id', $userId)->where('receiver_id', $contact->id_user);
                })
                ->orWhere(function ($q) use ($userId, $contact) {
                    $q->where('sender_id', $contact->id_user)->where('receiver_id', $userId);
                })
                ->orderBy('created_at', 'desc')
                ->first();

            $unreadCount = Message::where('sender_id', $contact->id_user)
                ->where('receiver_id', $userId)
                ->where('is_read', false)
                ->count();

            return [
                'id_user'       => $contact->id_user,
                'nama'          => $contact->nama,
                'photo_profile' => $contact->photo_profile,
                'role'          => $contact->role,
                'last_message'  => $lastMessage ? $lastMessage->message : null,
                'last_time'     => $lastMessage ? $lastMessage->created_at->format('H:i') : null,
                'last_timestamp'=> $lastMessage ? $lastMessage->created_at->timestamp : 0,
                'unread_count'  => $unreadCount,
            ];
        });

        // Urutkan kontak berdasarkan pesan terakhir paling baru
        $contacts = $contacts->sortByDesc('last_timestamp')->values();

        return response()->json($contacts);
    }

    /**
     * Ambil riwayat chat antara user dengan kontak tertentu
     */
    public function messages($contactId)
    {
        $session = UserSession::getInstance();
        $user = $session->getUser();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $userId = $user->id_user;

        // Tandai semua pesan dari kontak ini sebagai terbaca
        Message::where('sender_id', $contactId)
            ->where('receiver_id', $userId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $messages = Message::where(function ($q) use ($userId, $contactId) {
                $q->where('sender_id', $userId)->where('receiver_id', $contactId);
            })
            ->orWhere(function ($q) use ($userId, $contactId) {
                $q->where('sender_id', $contactId)->where('receiver_id', $userId);
            })
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($msg) use ($userId) {
                return [
                    'id_message'  => $msg->id_message,
                    'sender_id'   => $msg->sender_id,
                    'receiver_id' => $msg->receiver_id,
                    'message'     => $msg->message,
                    'is_read'     => $msg->is_read,
                    'time'        => $msg->created_at->format('H:i'),
                    'is_sent'     => ($msg->sender_id == $userId),
                ];
            });

        return response()->json($messages);
    }

    /**
     * Kirim pesan baru
     */
    public function send(Request $request)
    {
        $session = UserSession::getInstance();
        $user = $session->getUser();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $userId = $user->id_user;

        $request->validate([
            'receiver_id' => 'required|integer',
            'message'     => 'required|string',
        ]);

        $msg = Message::create([
            'sender_id'   => $userId,
            'receiver_id' => $request->receiver_id,
            'message'     => $request->message,
            'is_read'     => false,
        ]);

        return response()->json([
            'success' => true,
            'message' => [
                'id_message'  => $msg->id_message,
                'sender_id'   => $msg->sender_id,
                'receiver_id' => $msg->receiver_id,
                'message'     => $msg->message,
                'is_read'     => $msg->is_read,
                'time'        => $msg->created_at->format('H:i'),
                'is_sent'     => true,
            ]
        ]);
    }

    /**
     * Polling pesan baru dari kontak tertentu (untuk real-time feel)
     */
    public function poll($contactId)
    {
        $session = UserSession::getInstance();
        $user = $session->getUser();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $userId = $user->id_user;

        // Ambil semua pesan unread dari kontak ini ke user, lalu tandai sebagai terbaca
        $newMessages = Message::where('sender_id', $contactId)
            ->where('receiver_id', $userId)
            ->where('is_read', false)
            ->get();

        if ($newMessages->count() > 0) {
            Message::where('sender_id', $contactId)
                ->where('receiver_id', $userId)
                ->where('is_read', false)
                ->update(['is_read' => true]);
        }

        $formatted = $newMessages->map(function ($msg) {
            return [
                'id_message'  => $msg->id_message,
                'sender_id'   => $msg->sender_id,
                'receiver_id' => $msg->receiver_id,
                'message'     => $msg->message,
                'is_read'     => true,
                'time'        => $msg->created_at->format('H:i'),
                'is_sent'     => false,
            ];
        });

        return response()->json($formatted);
    }
}
