<?php

namespace Cyrtolat\Channels\Tests;

use Cyrtolat\Channels\Telegram\TelegramMessage;

class TelegramMessageTest extends TestCase
{
    /**
     * Testing a constructor of TelegramMessage class.
     *
     * @test
     */
    public function testConstructor()
    {
        $content = "Hello, world!";
        $channel = "1234567890";

        $message = new TelegramMessage($content, $channel);

        $this->assertEquals($content, $message->getContent());
        $this->assertEquals($channel, $message->getChannel());
    }

    /**
     * Testing a constructor of TelegramBuilder class.
     *
     * @test
     */
    public function testBuilder()
    {
        $text = "Hello, world!";
        $chat_id = "1234567890";
        $parse_mode = 'HTML';
        $disable_web_page_preview = true;
        $disable_notification = true;

        $message = TelegramMessage::create()
            ->channel($chat_id)
            ->content($text)
            ->parseModeHtml()
            ->disableNotification()
            ->disableLinkPreview();

        $this->assertEquals($message->getContent(), $text);
        $this->assertEquals($message->getChannel(), $chat_id);
        $this->assertEquals($message->getParseMode(), $parse_mode);
        $this->assertEquals($message->isWebPagePreviewDisable(), $disable_web_page_preview);
        $this->assertEquals($message->isNotificationDisable(), $disable_notification);
    }

    /**
     * Testing an array serialization of TelegramMessage class.
     *
     * @test
     */
    public function testArraySerialization()
    {
        $array = [
            'chat_id' => '1234567890',
            'text' => 'Hello, world!',
            'parse_mode' => 'HTML',
            'disable_web_page_preview' => true,
            'disable_notification' => true
        ];

        $message = TelegramMessage::create()
            ->channel($array['chat_id'])
            ->content($array['text'])
            ->disableNotification()
            ->disableLinkPreview()
            ->parseModeHtml();

        $this->assertEquals($message->toArray(), $array);
    }

    /**
     * Testing a json serialization of TelegramMessage class.
     *
     * @test
     */
    public function testJsonSerialization()
    {
        $array = [
            'chat_id' => '1234567890',
            'text' => 'Hello, world!',
            'parse_mode' => 'Markdown',
            'disable_web_page_preview' => false,
            'disable_notification' => false,
        ];

        $message = TelegramMessage::create()
            ->channel($array['chat_id'])
            ->content($array['text']);

        $this->assertEquals($message->toJson(), json_encode($array));
    }
}