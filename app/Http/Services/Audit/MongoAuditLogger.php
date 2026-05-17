<?php

namespace App\Services\Audit;

use Illuminate\Support\Facades\Log;

class MongoAuditLogger
{
    public function logTransactionEvent(string $action, array $data): void
    {
        Log::channel('mongodb')->info($action, $data);
    }

    public function logFailedTransaction(string $reason, array $data): void
    {
        Log::channel('mongodb')->error('Transaction Failed: '.$reason, $data);
    }
}
