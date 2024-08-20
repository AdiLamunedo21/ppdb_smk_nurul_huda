<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LupaPasswordVerifikasi extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct($user)
    {
        $this->data = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Lupa Password')
                    ->greeting('Assalamualaikum')
                    ->line('Anda lupa password. Klik Link Berikut Untuk membuat password baru')
                    ->action('Password Baru', url('/lupa-password/buat?uid='.$this->data->lupa_password))
                    ->line('Link reset password berlaku sampai dengan **'.$this->data->lupa_password_expired.'**')
                    ->line('Terimakasih');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
