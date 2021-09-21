<?php

namespace App\Http\Middleware;

use App\Jobs\UrlLogJob;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

/**
 * Посредник отправляющий лог заходов в очередь
 */
class UrlLogger {
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        // в очередь отправки
        $details = [
            'url' => $request->getUri(), // или без домена $request->getRequestUri(),
            'created_at' => Carbon::now()->format('Y-m-d h:i:s'),
        ];
        dispatch(new UrlLogJob($details));

        return $next($request);
    }
}
