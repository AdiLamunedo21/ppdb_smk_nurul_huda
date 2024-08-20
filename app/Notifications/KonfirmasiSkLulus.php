<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class KonfirmasiSkLulus extends Notification
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
            $message = "Sk Lulus anda telah diterima. Silahkan cek Progres";
        }
        elseif($this->data == 'ditolak') {
            $message = "Maaf, Sk Lulus anda ditolak. Silahkan upload ulang Sk Lulus";
        } else {
            $message = "Bukti Sk Lulus sedang dalam proses pengecekan";
        }

        return [
            "message" => $message,
        ];
    }
}
