<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RedefenirSenhaNotification extends Notification
{
    use Queueable;
    public $token;
    public $email;
    public $name;

    /**
     * Create a new notification instance.
     */
    public function __construct($token, $email, $name)
    {
        $this->token = $token;
        $this->email = $email;
        $this->name = $name;

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
        $minutos = config('auth.passwords.'.config('auth.defaults.passwords').'.expire');
        $url = 'http://89.38.150.159/password/reset/' . $this->token . '?email=' . $this->email;
        return (new MailMessage)
            ->subject('Notificação de redefenição de password')
            ->greeting('Olá ' . $this->name)
            ->line('Este email foi enviado porque foi recebido uma requesição para redefenir a password para a sua conta.')
            ->action('Redefenição de password', $url)
            ->line('Este link para redefenir a password vai expirar em ' . $minutos . ' minutos.')
            ->line('Se esta requesição não eftuada por si não é necessário fazer nada.')
            ->salutation('Cumprimentos, ' . env('APP_NAME'));
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
