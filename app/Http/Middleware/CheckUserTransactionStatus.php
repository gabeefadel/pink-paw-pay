<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserTransactionStatus
{

    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        if($user->status !== 'active') {
            return response->json(['message'=>'usuário inativo ou bloqueado'],403);
        }
        if ($user->blocked_until && $user->blocked_until->isFuture()) {
            return response->json([
                'message' => 'Muitas tentativas de transação falhas. Tente novamente mais tarde',
                'blocked_until' => $user->blocked_until->toIso8601String()
            ],429);
        }
        return $next($request);
    }
}
