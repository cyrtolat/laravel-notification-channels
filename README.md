# Laravel Notification Channels

[![Latest Version on Packagist](https://img.shields.io/packagist/v/cyrtolat/laravel-channels?style=flat-square)](https://packagist.org/packages/cyrtolat/laravel-channels)
[![License](https://img.shields.io/github/license/cyrtolat/laravel-channels?style=flat-square)](https://packagist.org/packages/cyrtolat/laravel-channels)

> **_NOTE:_**  The package is in a state of slow development and currently contains only a telegram channel

## Contents
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#Usage)
    - [Telegram](#Telegram)
- [Testing](#testing)
- [Changelog](#changelog)
- [License](#license)

## Installation

Run the following command from you terminal:

```bash
composer require cyrtolat/laravel-channels
```

## Configuration

Configure your Telegram bot token and add channels as needed:

```php
# config/services.php

'telegram' => [
    'token' => env('TELEGRAM_TOKEN', 'YOUR TELEGRAM TOKEN HERE'),
    'channels' => [
        // 'channel-name' => 'channel id',
        // ...
    ]   
],
```

## Usage

### Telegram 

The channel receives an instance of the TelegramMessage class. Return only it from the `toTelegram()' method of your notification. If you need to send a simple text message without additional settings, then you can do it as follows:

```php
use Cyrtolat\Channels\Telegram\TelegramMessage;

$message = new TelegramMessage("Hello, world!", "1234567890");
```

You can also use the class self-building:

```php
use Cyrtolat\Channels\Telegram\TelegramMessage;

$message = TelegramMessage::create()
    ->channel("1234567890")
    ->content("<b>Hello</b>, <i>world</i>!")
    ->disableNotification()
    ->disableLinkPreview()
    ->parseModeHtml();
```

An example of a test notification is presented below:

```php
# Notifications/TestNotifications.php

use Illuminate\Bus\Queueable;
use Cyrtolat\Channels\Telegram\TelegramMessage;
use Illuminate\Notifications\Notification;

class TestNotification extends Notification
{
    use Queueable;

    /** ... */
    public function via($notifiable)
    {
        return ['telegram'];
    }

    /** ... */
    public function toTelegram($notifiable)
    {
        return TelegramMessage::create()
            ->channel($notifiable->telegram ?? "")
            ->content('Hello, world!')
            ->disableNotification()
            ->disableLinkPreview()
            ->parseModeHtml();
    }
}
```

## Testing

Phpunit is used to test this library. To start testing run the command:

```bash
$ composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [LICENSE](LICENSE.md) for more information.
