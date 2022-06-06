<?php

namespace Cyrtolat\Channels\Tests;

use Cyrtolat\Channels\Telegram\MessageBuilder;
use Cyrtolat\Channels\Telegram\TelegramMessage;

class TelegramMessageTest extends TestCase
{
    /** @var MessageBuilder */
    protected MessageBuilder $builder;

    public function setUp(): void
    {
        parent::setUp();

        $this->builder = new MessageBuilder();
    }

    /**
     * Testing a constructor of TelegramMessage class.
     *
     * @test
     */
    public function testConstructor()
    {
        $content = "Hello, world!";
        $message = new TelegramMessage($content);

        $this->assertEquals($content, $message->text);
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

        $message = $this->builder->reset()
            ->channel($chat_id)
            ->content($text)
            ->parseModeHtml()
            ->disableNotification()
            ->disableLinkPreview()
            ->getMessage();

        $this->assertEquals($message->text, $text);
        $this->assertEquals($message->chat_id, $chat_id);
        $this->assertEquals($message->parse_mode, $parse_mode);
        $this->assertEquals($message->disable_web_page_preview, $disable_web_page_preview);
        $this->assertEquals($message->disable_notification, $disable_notification);
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
            'disable_notification' => true,
        ];

        $message = $this->builder->reset()
            ->channel($array['chat_id'])
            ->content($array['text'])
            ->disableNotification()
            ->disableLinkPreview()
            ->parseModeHtml()
            ->getMessage();

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

        $message = $this->builder->reset()
            ->channel($array['chat_id'])
            ->content($array['text'])
            ->getMessage();

        $this->assertEquals($message->toJson(), json_encode($array));
    }
}