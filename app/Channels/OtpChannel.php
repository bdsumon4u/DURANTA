<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;

class OtpChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toOtp($notifiable);

        sleep(1);
        info('Sending SMS: ' . $message['code']);
        info('Direct Link: ' . $message['link']);
        // Send notification to the $notifiable instance...
    }
}
