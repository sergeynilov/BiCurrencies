<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class SendUserCurrencySubscriptionNotification extends Notification  implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public $from_cli;
    public $user;
    public $currenciesList;
    public $base_currency_code;
    public $operation_date;


    public function __construct(
        bool $from_cli = null,
        User $user,
        array $currenciesList,
        string $base_currency_code,
        string $operation_date
    ) {
        \Log::info(varDump($from_cli, ' -1 SendUserCurrencySubscriptionNotification $from_cli::'));
        $this->from_cli           = $from_cli;
        $this->user               = $user;
        $this->currenciesList     = $currenciesList;
        $this->base_currency_code = $base_currency_code;
        $this->operation_date     = $operation_date;
        $this->afterCommit();
    }


    /*         $currentUser->notify(new SendUserCurrencySubscriptionNotification(
        from_cli: $from_cli,
        user: $currentUser,
        currenciesList:$currenciesList,
        base_currency_code:$base_currency_code,
        operation_date: $operation_date
    ) ); */

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
//        return ['mail'];
        return ['database'];
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
            'from_cli'           => $this->from_cli,
            'user'               => $this->user,
            'currenciesList'     => $this->currenciesList,
            'base_currency_code' => $this->base_currency_code,
            'operation_date'     => $this->operation_date
        ];
    }

}
