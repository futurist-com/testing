<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EmailResetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $code;

    public function __construct($code)
    {
        //
        $this->code=$code;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $link = url("/#/register/reset-password/" . $this->code);
        return (new MailMessage)
            ->subject('Восстановление пароля')
            ->line("
            Здравствуйте! Вы получили это письмо, потому что мы получили запрос на сброс пароля для вашей учетной записи.")
            ->action('Код подтверждения для смены пароля', $this->code)
            ->line("Если вы не запрашивали сброс пароля, никаких дальнейших действий не предпринимайте.");
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
