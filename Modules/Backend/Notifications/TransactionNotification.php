<?php

namespace Modules\Backend\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TransactionNotification extends Notification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var
     */
    protected $message;
    protected $model;
    /**
     * @var $url
     */
    private $url;

    /**
     * Create a new notification instance.
     *
     * @param $model
     * @param $url
     * @param $message
     */
    public function __construct($model, $url, $message)
    {
        $this->model = $model;
        $this->url = $url;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return ['broadcast', 'database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->line($this->message)
            ->action('Show Transaction', $this->url)
            ->line('Thank you for using our application!');
    }

    /**
     * @param $notifiable
     * @return array
     */
    public function toArray($notifiable): array
    {
        return [
            'url' => $this->url,
            'message' => $this->message,
            'icon' => 'fa fa-money',  //fa-icons
        ];
    }

    /**
     * @param $notifiable
     * @return array
     */
    public function toDatabase($notifiable): array
    {
        return [
            'path' => $this->url,
            'message' => $this->message,
            'icon' => 'fa fa-money',  //fa-icons
        ];
    }
}
