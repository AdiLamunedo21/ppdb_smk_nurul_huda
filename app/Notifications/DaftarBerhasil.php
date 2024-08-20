<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class DaftarBerhasil extends Notification
{
    use Queueable;

    protected $data;

    public function __construct($user, $password)
    {
        $this->data = $user;
        $this->data->password = $password;
    }

    public function via($notifiable)
    {
        // Hanya mendukung pengiriman melalui database
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Pendaftaran Berhasil. Selamat Anda berhasil mendaftar!',
            'link' => '/dashboard', // Sesuaikan dengan link yang sesuai
        ];
    }
}

