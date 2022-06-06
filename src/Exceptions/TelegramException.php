<?php

namespace Cyrtolat\NotificationChannels\Exceptions;

class TelegramException extends ChannelException
{
    /**
     * Thrown when the Telegram channel gets a not a TelegramMessage class instance.
     *
     * @return static
     */
    public static function invalidMessageInstance(): self
    {
        return new static("Not the TelegramMessage object given to TelegramChannel.");
    }

    /**
     * Thrown when the Telegram bot token not provided.
     *
     * @return static
     */
    public static function invalidTokenException(): self
    {
        return new static("Telegram token not provided. Please, specify the token correctly in your config file.");
    }

    /**
     * Thrown when the Telegram chat ID not provided.
     *
     * @return static
     */
    public static function invalidChannelProvided(): self
    {
        return new static("Telegram channel not provided. Please, specify the Telegram chat ID of the message correctly.");
    }

    /**
     * Thrown when the response from the Telegram contains an error.
     *
     * @return static
     */
    public static function telegramErrorResponse(): self
    {
        return new static("Telegram response contains an error.");
    }

    /**
     * Thrown when we're unable to communicate with Telegram.
     *
     * @return static
     */
    public static function clientErrorResponse(): self
    {
        return new static("There is a client error response.");
    }
}
