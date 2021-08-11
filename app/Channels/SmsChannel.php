<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;

class SmsChannel
{
    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     * @return void
     * @throws \Exception
     */
    public function send($notifiable, Notification $notification)
    {
        $message = data_get($notification->toArray($notifiable), 'message');

        $this->sendSingleMessage($notifiable->phone, $message, '1|0', /* strtotime("+2 minutes") */);
    }

    /**
     * @throws \Exception
     */
    public function sendSingleMessage($number, $message, $device = 0, $schedule = null, $isMMS = false, $attachments = null)
    {
        return $this->sendRequest('https://sms.hotash.tech/services/send.php', [
            'number' => $number,
            'message' => $message,
            'schedule' => $schedule,
            'key' => '7ea3e46311476e5311343150dcff4ad946dc473b',
            'devices' => $device,
            'type' => $isMMS ? "mms" : "sms",
            'attachments' => $attachments
        ])["messages"][0];
    }

    /**
     * @throws \Exception
     */
    public function sendRequest($url, $postData)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (curl_errno($ch)) {
            throw new \Exception(curl_error($ch));
        }
        curl_close($ch);
        if ($httpCode == 200) {
            $json = json_decode($response, true);
            if ($json == false) {
                if (empty($response)) {
                    throw new \Exception("Missing data in request. Please provide all the required information to send messages.");
                } else {
                    throw new \Exception($response);
                }
            } else {
                if ($json["success"]) {
                    return $json["data"];
                } else {
                    throw new \Exception($json["error"]["message"]);
                }
            }
        } else {
            throw new \Exception("HTTP Error Code : {$httpCode}");
        }
    }
}
