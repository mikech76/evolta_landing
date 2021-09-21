<?php

namespace App\Http\Controllers;

use App\Services\JsonRpcClient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Контроллер просмотра статистики заходов
 */
class HistoryActivityController extends Controller {
    /**
     * @var JsonRpcClient Клиент
     */
    protected $client;

    public function __construct(JsonRpcClient $client) {
        $this->client = $client;
    }

    /**
     * Статистика заходов
     *
     * @param Request $request
     *
     * @return JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function index(Request $request): JsonResponse {
        $data = $this->client->send('UrlLogger@stats', [
            'page' => (int)$request->get('page'),
            'per_page' => (int)$request->get('per_page'),
        ]);

        dd($data);
        return new JsonResponse($data);
    }

}
