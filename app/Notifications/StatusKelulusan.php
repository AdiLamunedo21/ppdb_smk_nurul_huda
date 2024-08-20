<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Carbon\Carbon;

class StatusKelulusan extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($peserta, $biaya = [], $gelombang)
    {
        $this->data = $peserta;
        $this->data->biaya = $biaya;
        $this->data->gelombang = $gelombang;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if ($this->data->status_kelulusan == 'lulus') {
            $total = 0;
            if (!empty($this->data->biaya)){
                foreach($this->data->biaya as $row) {
                    $total += $row->nominal;
                }
            }

            // $limit_pembayaran = Carbon::parse($this->data->tanggal_kelulusan)->addDay(14)->isoFormat('dddd, D MMMM Y');
            if ($this->data->gelombang) {
                $limit_pembayaran = Carbon::parse($this->data->gelombang->batas_pembayaran)->isoFormat('dddd, D MMMM Y');
            }

            $total_biaya = 0;
            $potongan = 0;
            $total_dibayar = 0;
            $DPP = 1500000;
            if (count($this->data->biaya) > 0) {
                foreach($this->data->biaya as $val){
                    $total_biaya += $val->nominal;

                    // if ($val->komponen_biaya == "Angsuran 1" && $this->data->gelombang && $this->data->gelombang->potongan_angsuran_1) {
                    //     $potongan = $total_biaya*$this->data->gelombang->potongan_angsuran_1;
                    // }
                }
            }
            if ($this->data->gelombang && $this->data->gelombang->potongan_angsuran_1) {
                $potongan = $DPP*$gelombang->potongan_angsuran_1;
                $total_dibayar = $total_biaya - $potongan;
            } else {
                $total_dibayar = $total_biaya;
            }

            return (new MailMessage)
                    ->subject('Status Kelulusan PMB UNH')
                    ->view('pages.email.rincian-biaya', [
                        'peserta' => $this->data,
                        'biaya' => $this->data->biaya,
                        'total' => $total,
                        'potongan' => $potongan,
                        'total_biaya' => $total_biaya,
                        'total_dibayar' => $total_dibayar,
                        'gelombang' => $this->data->gelombang,
                        'limit_pembayaran' => $limit_pembayaran
                    ]);
            exit;
        }
        else if ($this->data->status_kelulusan == 'tidak lulus') {
            $msg = 'Maaf. Anda TIDAK LULUS menjadi Siswa SMK Nurul Huda';
        }
        else {
            $msg = 'Berkas prestasi anda sedang di cek';
        }

        return (new MailMessage)
                    ->greeting('Assalamualaikum warahmatullahi wabarakatuh')
                    ->subject('Status Kelulusan PMB UNH')
                    ->line($msg)
                    ->salutation('Wassalamualaikum');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        if ($this->data->status_kelulusan == 'lulus') {
            $msg = 'Selamat anda telah DITERIMA menjadi Siswa SMK Nurul Huda';
        }
        else if ($this->data->status_kelulusan == 'tidak lulus') {
            $msg = 'Maaf. Anda TIDAK LULUS menjadi Siswa SMK Nurul Huda';
        }
        else {
            $msg = 'Berkas prestasi anda sedang di cek';
        }

        return [
            'message' => $msg,
            'link' => '#'
        ];
    }

    public function toArray($notifiable)
    {
        if ($this->data->status_kelulusan == 'lulus') {
            $msg = 'Selamat anda telah DITERIMA menjadi Siswa SMK Nurul Huda';
        }
        else if ($this->data->status_kelulusan == 'tidak lulus') {
            $msg = 'Maaf. Anda TIDAK LULUS menjadi Siswa SMK Nurul Huda';
        }
        else {
            $msg = 'Berkas prestasi anda sedang di cek';
        }

        return [
            'message' => $msg,
            'link' => '#'
        ];
    }
}
