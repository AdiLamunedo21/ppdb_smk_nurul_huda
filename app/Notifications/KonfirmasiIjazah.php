<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class KonfirmasiIjazah extends Notification
{
    use Queueable;

    public function __construct($status)
    {
        $this->data = $status;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        if ($this->data == 'diterima') {
            $message = "Ijazah anda telah diterima. Silahkan cek Progres";
        }
        elseif($this->data == 'ditolak') {
            $message = "Maaf, Ijazah anda ditolak. Silahkan upload ulang Ijazah";
        } else {
            $message = "Bukti Ijazah sedang dalam proses pengecekan";
        }

        return [
            "message" => $message,
        ];
    }
}
