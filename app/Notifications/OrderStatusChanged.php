<?php

namespace App\Notifications;

use App\Models\Admin;
use App\Models\Order;
use App\Models\Seller;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderStatusChanged extends Notification implements ShouldQueue
{
    use Queueable;

    private Order $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
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
        if ($notifiable instanceof Admin) {
            $link = route('admin.orders.edit', $this->order);
        } else if ($notifiable instanceof Seller) {
            $link = route('seller.orders.index');
        } else {
            $link = route('orders.show', $this->order);
        }

        return [
            'message' => 'Your order #' . $this->order->id . ' status is changed.',
            'link' => $link,
        ];
    }
}
