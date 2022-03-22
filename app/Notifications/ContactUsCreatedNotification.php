<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Settings;
use App\Models\User;

class ContactUsCreatedNotification extends Notification
{
    use Queueable;

    public $title;
    public $content_message;
    public $user_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $title, string $content_message, int $user_id)
    {
//        \Log::info(varDump($title, ' -1 CurrencyRatesImportRun $title::'));
        $this->title           = $title;
        $this->content_message = $content_message;
        $this->user_id            = $user_id;
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
            ->line('The introduction to the notification.11')
            ->action('Notification Action 22', url('/'))
            ->line('Thank you for using our application! 33');
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
            'title' => $this->title,
            'content_message'     => $this->content_message,
            'user_id'     => $this->user_id,
        ];
    }
}
