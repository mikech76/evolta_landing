<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;

/**
 * JsonRpcClient
 */
class JsonRpcClient {
    const JSON_RPC_VERSION = '2.0';

    const METHOD_URI = 'endpoint';

    protected $client;

    /**
     * Конструктор, создаем клиент GuzzleHttp
     */
    public function __construct() {
        $this->client = new Client([
            'headers' => ['Content-Type' => 'application/json'],
            'base_uri' => env('ACTIVITY_API_URL'),
            'auth' => [env('ACTIVITY_API_USER'), env('ACTIVITY_API_PASS')],
        ]);
    }

    /**
     * Отправить запрос RPC
     *
     * @param string $method
     * @param array $params
     *
     * @return array
     * @throws GuzzleException
     */
    public function send(string $method, array $params): array {
        $response = $this->client
            ->post(self::METHOD_URI, [
                RequestOptions::JSON => [
                    'jsonrpc' => self::JSON_RPC_VERSION,
                    'id' => time(),
                    'method' => $method,
                    'params' => $params
                ]
            ])->getBody()->getContents();

        return json_decode($response, true);
    }
}
