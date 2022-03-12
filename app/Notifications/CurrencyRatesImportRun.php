<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Settings;
use App\Models\User;


class CurrencyRatesImportRun extends Notification
{
    use Queueable;

    public $from_cli;
    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(bool $from_cli, User $user= null)
    {
        $this->from_cli = $from_cli;
        $this->user     = $user;
        $this->afterCommit();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
//        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'from_cli' => $this->from_cli,
            'user'     => $this->user
        ];
    }
}
