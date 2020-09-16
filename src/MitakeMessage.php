<?php

namespace NotificationChannels\Mitake;

class MitakeMessage
{
    /**
     * The message content.
     *
     * @var string
     */
    public $content;

    /**
     * Recipient's mobile number
     *
     * @var string
     */
    public $to;

    /**
     * Sms Delivery time
     *
     * @var string(YYYYMMDDHHMMSS)|integer(second)|null
     */
    public $dlvTime;

    /**
     * Validity period
     *
     * @var string(YYYYMMDDHHMMSS)|integer(second)|null
     */
    public $vldTime;

    /**
     * Check duplicate sending
     *
     * @var string
     */
    public $clientId;

    /**
     * Create a new message instance.
     *
     * @param string $content
     * @return void
     */
    public function __construct($content = '')
    {
        $this->content = $content;
    }

    /**
     * Set the message content.
     *
     * @param string $content
     * @return $this
     */
    public function content($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @param mixed $to
     * @return MitakeMessage
     */
    public function to($to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * @param $dlvTime string|integer
     * @return MitakeMessage
     */
    public function dlvTime($dlvTime)
    {
        $this->dlvTime = $dlvTime;

        return $this;
    }

    /**
     * @param $vldTime string|integer
     *      YYYYMMDDHHMMSS | second
     * @return MitakeMessage
     */
    public function vldTime($vldTime)
    {
        $this->vldTime = $vldTime;

        return $this;
    }

    /**
     * @param $clientId string
     * @return MitakeMessage
     */
    public function clientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }
}
