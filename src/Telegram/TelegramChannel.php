<?php

namespace Cyrtolat\Channels\Telegram;

use Cyrtolat\Channels\Exceptions\TelegramException;
use Illuminate\Notifications\Notification;

/**
 * Broadcast telegram channel class.
 */
final class TelegramChannel
{
    /** @var TelegramClient */
    protected $telegram;

    /** Channel constructor. */
    public function __construct()
    {
        $this->telegram = new TelegramClient();
    }

    /**
     * Determine if the notification should be sent.
     *
     * @param mixed $notifiable
     * @param Notification $notification
     * @throws TelegramException
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toTelegram($notifiable);

        if (!$message instanceof TelegramMessage) {
            throw TelegramException::invalidMessageInstance();
        }

        if (blank($message->getChannel())) {
            $message->channel($notifiable->routeNotificationFor('telegram', $notification));
        }

        if (blank($message->getChannel())) {
            throw TelegramException::invalidChannelProvided();
        }

        $this->telegram->sendMessage($message);
    }
}
