<?php

namespace Cyrtolat\Channels\Telegram;

use Illuminate\Notifications\Notification;

/**
 * Broadcast telegram channel class.
 */
final class TelegramChannel
{
    /**
     * Determine if the notification should be sent.
     *
     * @param mixed $notifiable
     * @param Notification $notification
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send($notifiable, Notification $notification): void
    {
        $message = $notification->toTelegram($notifiable);
        $channel = $message->chat_id ?: $notifiable->routeNotificationFor('telegram', $notification);

        if ($message instanceof TelegramMessage) {
            $client = new TelegramClient();
            $client->sendMessage($message, $channel);
        }

        if (is_string($message)) {
            $message = (new MessageBuilder())
                ->content($message)
                ->getMessage();
            $client = TelegramClient::getInstance();
            $client->sendMessage($message, $channel);
        }
    }
}
