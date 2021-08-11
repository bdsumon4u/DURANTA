<?php

namespace App\Notifications\Auth;

use App\Channels\SmsChannel;
use App\Models\Seller;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Config;

class VerifyPhone extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * The callback that should be used to create the verify phone URL.
     *
     * @var \Closure|null
     */
    public static $createUrlCallback;

    /**
     * The callback that should be used to build the sms message.
     *
     * @var \Closure|null
     */
    public static $toSmsCallback;

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

    /**
     * Build the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     * @throws \Exception
     */
    public function toArray($notifiable)
    {
        cache()->put(
            $notifiable->getTable() . ':otp:' . $notifiable->getKey(),
            $code = sprintf('%06d', random_int(0, 999999)),
            Config::get('auth.verification.expire', 60)
        );

        $link = $this->verificationUrl($notifiable, $code);

        if (static::$toSmsCallback) {
            return call_user_func(static::$toSmsCallback, $notifiable, $code);
        }

        return [
            'message' => 'Your OTP for DURANTA is: ' . $code,
        ];
    }

    /**
     * Get the verification URL for the given notifiable.
     *
     * @param mixed $notifiable
     * @param string $code
     * @return string
     */
    protected function verificationUrl($notifiable, $code)
    {
        if (static::$createUrlCallback) {
            return call_user_func(static::$createUrlCallback, $notifiable);
        }

        $prefix = $notifiable instanceof Seller ? 'seller.' : '';
        return route($prefix . 'verification.verify', [$notifiable->getKey(), $code]);
    }

    /**
     * Set a callback that should be used when creating the email verification URL.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function createUrlUsing($callback)
    {
        static::$createUrlCallback = $callback;
    }

    /**
     * Set a callback that should be used when building the notification mail message.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function toMailUsing($callback)
    {
        static::$toSmsCallback = $callback;
    }
}
