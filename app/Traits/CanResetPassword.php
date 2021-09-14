<?php

namespace App\Traits;

use App\Notifications\Auth\ResetPassword;

trait CanResetPassword
{
    /**
     * Get the phone number where password reset links are sent.
     *
     * @return string
     */
    public function getPhoneForPasswordReset()
    {
        return $this->phone;
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }
}
