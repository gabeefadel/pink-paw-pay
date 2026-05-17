<?php

namespace App\Services\Security;

use Illuminate\Support\Facades\Crypt;

class DataSecurityService
{
    public function encryptSensitiveData(string $data): string
    {
        return Crypt::encryptString($data);
    }

    public function maskDocument(string $document): string
    {
        return substr_replace($document, '***', 0, 3).substr($document, 3, 6);
    }

    public function getLastFour(str $cardNumber): ?string
    {
        return $cardNumber ? substr($cardNumber, -4) : null;
    }
}
