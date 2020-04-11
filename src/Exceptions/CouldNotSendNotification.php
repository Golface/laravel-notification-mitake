<?php

namespace NotificationChannels\Mitake\Exceptions;

class CouldNotSendNotification extends \Exception
{
    public static function serviceRespondedWithAnError($response)
    {
        return new static("Send sms failed...");
    }
}
