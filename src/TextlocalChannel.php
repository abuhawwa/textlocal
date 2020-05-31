<?php

namespace Abuhawwa\Textlocal;

use Illuminate\Notifications\Notification;

class TextlocalChannel extends Textlocal
{
    private $sender;

    /**
     * @param  TextlocalClient
     */
    public function __construct()
    {
        parent::__construct('', '', config('textlocal.key'));
        $this->sender = config('textlocal.sender');
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  Notification  $notification
     *
     * @throws CouldNotSendNotification
     *
     * @return array|null
     */
    public function send($notifiable, Notification $notification)
    {
        if (!$to = $notifiable->routeNotificationFor('textlocal'))
            return;
        if (empty($to))
            return;
        if (!is_array($to))
            $to = [$to];

        $message = $notification->toTextlocal($notifiable);
        if (empty($message))
            return;
        if (is_string($message))
            $message = new TextlocalMessage($message);

        return $this->sendSms($to, trim($message->content), $this->sender);
    }
}
