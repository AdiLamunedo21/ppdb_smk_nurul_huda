<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UploadBukti extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $nama_peserta)
    {
        $this->data = $user;
        $this->nama_peserta = $nama_peserta;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            "message" => $this->nama_peserta." telah mengupload bukti pembayaran",
            "link" => "/status-pembayaran"
        ];
    }
}
