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

    /*
     * Recipient's mobile number
     *
     * @var string
     */
    public $to;

    /*
     * Validity period
     *
     * @param $vldtime string(YYYYMMDDHHMMSS)|integer(second)
     */
    public $vldTime;

    /*
     * Check duplicate sending
     *
     * string
     */
    public $clientId;

    /**
     * Create a new message instance.
     *
     * @param  string  $content
     * @return void
     */
    public function __construct($content = '')
    {
        $this->content = $content;
    }

    /**
     * Set the message content.
     *
     * @param  string  $content
     * @return $this
     */
    public function content($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @param mixed $to
     */
    public function to($to)
    {
        $this->to = $to;
    }

    /**
     * @param $vldTime string(YYYYMMDDHHMMSS)|integer(second)
     */
    public function vldTime($vldTime)
    {
        $this->vldTime = $vldTime;
    }

    /**
     * @param $clientId string
     */
    public function clientId($clientId)
    {
        $this->clientId = $clientId;
    }
}
