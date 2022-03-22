<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Settings;
use App\Models\User;


class CurrencyRatesImportRunNotification extends Notification
{
    use Queueable;

    public $from_cli;
    public $user_id;
    public $new_currency_rate_added;
    public $base_currency_code;
    public $operation_date;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(
        bool $from_cli=null,
        int $user_id = null,
        int $new_currency_rate_added,
        string $base_currency_code,
        string $operation_date
    ) {
        \Log::info(varDump($from_cli, ' -1 CurrencyRatesImportRun $from_cli::'));
        $this->from_cli                = $from_cli;
        $this->user_id                 = $user_id;
        $this->new_currency_rate_added = $new_currency_rate_added;
        $this->base_currency_code      = $base_currency_code;
        $this->operation_date          = $operation_date;
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
            'from_cli'                => $this->from_cli,
            'user_id'                 => $this->user_id,
            'new_currency_rate_added' => $this->new_currency_rate_added,
            'base_currency_code'      => $this->base_currency_code,
            'operation_date'          => $this->operation_date
        ];
    }
}
