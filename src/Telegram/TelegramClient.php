<?php

namespace Cyrtolat\Channels\Telegram;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use Cyrtolat\Channels\Exceptions\TelegramException;

/**
 * Telegram client class.
 */
final class TelegramClient
{
    /** @var string */
    protected $token;

    /** @var string */
    protected $baseUri;

    /** @var GuzzleClient */
    protected GuzzleClient $client;

    /**
     * Private constructor. Use `getInstance()` to obtain the singleton instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->token = config('services.telegram.token');
        $this->baseUri = 'https://api.telegram.org/bot';

        $this->client = new GuzzleClient();
    }

    /**
     * Sending a message to a chat.
     *
     * @param TelegramMessage $message
     * @param string $channel
     * @throws TelegramException
     * @return void
     */
    public function sendMessage(TelegramMessage $message, string $channel): void
    {
        $uri = $this->baseUri . $this->token . '/sendMessage';

        $this->sendRequest($uri, [
            'form_params' => array_merge($message->toArray(), [
                'chat_id' => $channel
            ])
        ]);
    }

    /**
     * Sending a request to the telegram server.
     *
     * @param string $uri
     * @param array $params
     * @return ResponseInterface|null
     * @throws TelegramException
     */
    protected function sendRequest(string $uri, array $params): ?ResponseInterface
    {
        if (blank($this->token)) {
            throw TelegramException::invalidTokenException();
        }

        try {
            return $this->client->post($uri, $params);
        }
        catch (ClientException $exception) {
            throw TelegramException::telegramErrorResponse();
        }
        catch (GuzzleException $exception) {
            throw TelegramException::clientErrorResponse();
        }
    }
}
