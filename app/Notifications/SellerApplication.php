<?php

namespace App\Notifications;

use App\Models\Admin;
use App\Models\Sellership;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SellerApplication extends Notification implements ShouldQueue
{
    use Queueable;

    public Sellership $sellership;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Sellership $sellership)
    {
        $this->sellership = $sellership;
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
            return [
                'message' => 'You\'ve a new sellership application.',
                'link' => route('seller.sellership.edit', $this->sellership),
            ];
        }
        return [
            'message' => 'Your sellership application is ' . $this->sellership->status,
        ];
    }
}
