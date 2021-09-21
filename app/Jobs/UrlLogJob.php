<?php

namespace App\Jobs;

use App\Services\JsonRpcClient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Задача отправки лога
 */
class UrlLogJob implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array Данные задачи
     */
    protected $details;

    /**
     * Конструктор
     *
     * @param array $details Данные
     */
    public function __construct(array $details) {
        $this->details = $details;
        // $this->onQueue('url_logger');
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle() {
        /** @var JsonRpcClient $client */
        $client = new JsonRpcClient();

        // отправка на activity
        $data = $client->send('UrlLogger@save', $this->details);

        // если ошибка в API задача файлед
        if ($data['error'] ?? 0) {
            throw new \Exception($data['error']['message']);
        }
    }
}
