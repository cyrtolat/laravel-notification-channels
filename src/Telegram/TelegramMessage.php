<?php

namespace Cyrtolat\Channels\Telegram;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

/**
 * The outgoing telegram message class.
 */
final class TelegramMessage implements Arrayable, Jsonable
{
    /**
     * Unique identifier for the target chat or username of the target channel.
     *
     * @var string
     */
    protected $chat_id = '';

    /**
     * Text of the message to be sent.
     *
     * @var string
     */
    protected $text = '';

    /**
     * Send Markdown or HTML, if you want Telegram apps to show bold, italic,
     * fixed-width text or inline URLs in your bot's message.
     * "Markdown" is default
     *
     * @var string
     */
    protected $parse_mode = 'Markdown';

    /**
     * Disables link previews for links in this message
     *
     * @var bool
     */
    protected $disable_web_page_preview = false;

    /**
     * Sends the message silently. iOS users will not receive a notification,
     * Android users will receive a notification with no sound.
     *
     * @var bool
     */
    protected $disable_notification = false;

//    /**
//     * A JSON-serialized object for an inline keyboard, custom reply keyboard,
//     * instructions to hide reply keyboard or to force a reply from the user.
//     *
//     * @var string
//     */
//    protected $reply_markup = '';

    /**
     * The class constructor.
     *
     * @param string $message text message
     * @param string $channel the ID of the telegram chat
     */
    public function __construct(string $message = '', string $channel = '')
    {
        $this->text = $message;
        $this->chat_id = $channel;
    }

    /** @return TelegramMessage */
    public static function create(): self
    {
        return new TelegramMessage();
    }

    /**
     * Sets the Telegram chat ID of the message.
     *
     * @param string $chat_id
     * @return $this
     */
    public function channel(string $chat_id): self
    {
        $this->chat_id = $chat_id;

        return $this;
    }

    /**
     * Sets the text of the message.
     *
     * @param string $text
     * @return $this
     */
    public function content(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Sets the parse mode of the message to "HTML".
     * Default is "Markdown".
     *
     * @return $this
     */
    public function parseModeHtml(): self
    {
        $this->parse_mode = "HTML";

        return $this;
    }

    /**
     * Disables link previews for links in this message.
     *
     * @return $this
     */
    public function disableLinkPreview()
    {
        $this->disable_web_page_preview = true;

        return $this;
    }

    /**
     * Sends the message silently. iOS users will not receive a notification,
     * Android users will receive a notification with no sound.
     *
     * @return $this
     */
    public function disableNotification()
    {
        $this->disable_notification = true;

        return $this;
    }

    /** @return string */
    public function getChannel(): string
    {
        return $this->chat_id;
    }

    /** @return string */
    public function getContent(): string
    {
        return $this->text;
    }

    /** @return string */
    public function getParseMode(): string
    {
        return $this->parse_mode;
    }

    /** @return bool */
    public function isWebPagePreviewDisable(): bool
    {
        return $this->disable_web_page_preview;
    }

    /** @return bool */
    public function isNotificationDisable(): bool
    {
        return $this->disable_notification;
    }

    /** {@inheritdoc} */
    public function toArray(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'text' => $this->text,
            'parse_mode' => $this->parse_mode,
            'disable_web_page_preview' => $this->disable_web_page_preview,
            'disable_notification' => $this->disable_notification
        ];
    }

    /** {@inheritdoc} */
    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }
}
