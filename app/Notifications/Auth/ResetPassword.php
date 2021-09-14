<?php

namespace App\Notifications\Auth;

use App\Channels\SmsChannel;
use App\Models\Admin;
use App\Models\Seller;
use Illuminate\Notifications\Notification;

class ResetPassword extends Notification
{
    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return [SmsChannel::class];
    }

    public function toArray($notifiable)
    {
        if ($notifiable instanceof Admin) {
            $link = route('admin.password.reset', [$this->token, 'phone' => $notifiable->phone]);
        } else if ($notifiable instanceof Seller) {
            $link = route('seller.password.reset', [$this->token, 'phone' => $notifiable->phone]);
        } else {
            $link = route('password.reset', [$this->token, 'phone' => $notifiable->phone]);
        }

        return [
            'message' => 'Your password reset code is: ' . $this->token . '. Or visit ' . $link,
        ];
    }
}
