<?php

use App\Http\Controllers\DonationController;
use App\Http\Middleware\CheckUserTransactionStatus;
use App\Http\Middleware\EnsureIdempotency;

Route::middleware([
    'auth:sanctum',                  
    'throttle:donations',            
    CheckUserTransactionStatus::class,
    EnsureIdempotency::class
])->group(function () {
    
    Route::post('/donations', [DonationController::class, 'store']);
    
});