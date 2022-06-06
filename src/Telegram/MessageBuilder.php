<?php

namespace Cyrtolat\Channels\Telegram;

/**
 * TelegramMessage builder class.
 */
final class MessageBuilder
{
    /** @var TelegramMessage */
    private TelegramMessage $message;

    /**
     * The class constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->reset();
    }

    /**
     * Resets the message object.
     *
     * @return $this
     */
    public function reset(): self
    {
        $this->message = new TelegramMessage();

        return $this;
    }

    /**
     * Sets the chat_id of the message.
     *
     * @param string $chat_id
     * @return $this
     */
    public function channel(string $chat_id): self
    {
        $this->message->chat_id = $chat_id;

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
        $this->message->text = $text;

        return $this;
    }

    /**
     * Sets the parse mode of the message to "HTML".
     *
     * @return $this
     */
    public function parseModeHtml(): self
    {
        $this->message->parse_mode = "HTML";

        return $this;
    }

    /**
     * Sets the parse mode of the message to "Markdown".
     *
     * @return $this
     */
    public function parseModeMarkdown(): self
    {
        $this->message->parse_mode = "Markdown";

        return $this;
    }

    /**
     * Disables link previews for links in this message.
     *
     * @return $this
     */
    public function disableLinkPreview()
    {
        $this->message->disable_web_page_preview = true;

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
        $this->message->disable_notification = true;

        return $this;
    }

    /**
     * Returns the final instance of the message.
     *
     * @return TelegramMessage
     */
    public function getMessage(): TelegramMessage
    {
        $result = $this->message;
        $this->reset();

        return $result;
    }
}
