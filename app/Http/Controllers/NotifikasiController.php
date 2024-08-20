<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class NotifikasiController extends Controller
{
    public function json()
    {
        $user_id = auth()->user()->id;

        $user = User::find($user_id);
        $data = $user->unreadNotifications;

        return response()->json($data);
    }

    public function markAsRead()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        foreach ($user->unreadNotifications as $notification) {
            $notification->markAsRead();
        }

        return response()->json(true);
    }
}
