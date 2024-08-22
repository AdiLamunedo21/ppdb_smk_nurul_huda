<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UploadBukti extends Notification
{
    use Queueable;

    protected $data;
    protected $nama_peserta;
    protected $jenis_berkas;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $nama_peserta, $jenis_berkas)
    {
        $this->data = $user;
        $this->nama_peserta = $nama_peserta;
        $this->jenis_berkas = $jenis_berkas;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        $link = $this->jenis_berkas == 'ijazah' ? "/status-ijazah" : "/status-sk-lulus";

        return [
            "message" => $this->nama_peserta . " telah mengupload bukti " . ucfirst($this->jenis_berkas),
            "link" => $link,
        ];
    }
}
