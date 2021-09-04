<?php

namespace App\Notifications\Seller;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SellerWalletUpdated extends Notification implements ShouldQueue
{
    use Queueable;

    private Order $order;
    private string $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order, string $message)
    {
        $this->order = $order;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            'message' => $this->message,
            'link' => route('seller.orders.index'),
        ];
    }
}
