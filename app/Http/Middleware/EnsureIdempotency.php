<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class EnsureIdempotency
{

    public function handle(Request $request, Closure $next): Response
    {
        $idempotencyKey = $request->header('X-Idempotency-Key');

        if(!$idempotencyKey) {
            return response->json([
                'error' => 'Header X-Idempotency-Key é obrigatório para transações.'
            ],400);
        }

        $userUuid = $request->user()?->uuid ?? 'guest';
        $cacheKey = "idempotency_{$userUuid}_{$idempotencyKey}";
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }
        $response = $next($request);
        if ($response->isSuccessful()) {
            Cache::put($cacheKey, $response, now()->addHours(24));
        }
        return $response;
    }
}
