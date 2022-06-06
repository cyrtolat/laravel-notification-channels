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
    public $chat_id = '';

    /**
     * Text of the message to be sent.
     *
     * @var string
     */
    public $text = '';

    /**
     * Send Markdown or HTML, if you want Telegram apps to show bold, italic,
     * fixed-width text or inline URLs in your bot's message.
     * "Markdown" is default
     *
     * @var string
     */
    public $parse_mode = 'Markdown';

    /**
     * Disables link previews for links in this message
     *
     * @var bool
     */
    public $disable_web_page_preview = false;

    /**
     * Sends the message silently. iOS users will not receive a notification,
     * Android users will receive a notification with no sound.
     *
     * @var bool
     */
    public $disable_notification = false;

//    /**
//     * A JSON-serialized object for an inline keyboard, custom reply keyboard,
//     * instructions to hide reply keyboard or to force a reply from the user.
//     *
//     * @var string
//     */
//    public $reply_markup = '';

    /**
     * The class constructor.
     *
     * @param string $message
     */
    public function __construct(string $message = "")
    {
        $this->text = $message;
    }

    /** {@inheritdoc} */
    public function toArray(): array
    {
        return (array) $this;
    }

    /** {@inheritdoc} */
    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }
}
