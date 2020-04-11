<?php

namespace NotificationChannels\Mitake;

use Illuminate\Notifications\Notification;

class MitakeChannel
{
    protected $mitake;

    /**
     * MitakeChannel constructor.
     * @param Mitake $mitake
     */
    public function __construct(Mitake $mitake)
    {
        $this->mitake = $mitake;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @return mixed|void
     * @throws \NotificationChannels\Mitake\Exceptions\CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toMitake($notifiable);

        if (is_string($message)) {
            $message = new MitakeMessage($message);
        }

        if (!isset($message->to)) {
            if (! $to = $notifiable->routeNotificationFor('mitake', $notification)) {
                return;
            }

            $message->to($to);
        }

        return $this->mitake->send([
            'dstaddr' => $message->to,
            'smbody' => trim($message->content),
            'vldtime' => $message->vldTime,
            'clientid' => $message->clientId
        ]);
    }
}
