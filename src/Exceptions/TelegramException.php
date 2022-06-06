<?php

namespace Cyrtolat\Channels\Exceptions;

class TelegramException extends ChannelException
{
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
