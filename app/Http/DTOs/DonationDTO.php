<?php

namespace App\DTOs;

readonly class DonationDTO
{
    public function __construct(
        public float $amount,
        public string $document,
        public int $paymentMethodId,
        public ?string $cardNumber = null,
        public ?string $cardCvv = null,
        public ?string $cardExpiry = null,
        public ?string $cardHolderName = null,
        public ?string $description = null,
        public string $ipAddress,    
        public string $userAgent,   
    ) {}

  
    public static function fromRequest(array $validated): self
    {
        return new self(
            amount: (float) $validated['amount'],
            document: $validated['document'],
            paymentMethodId: (int) $validated['payment_method_id'],
            cardNumber: $validated['card_number'] ?? null,
            cardCvv: $validated['card_cvv'] ?? null,
            cardExpiry: $validated['card_expiry'] ?? null,
            cardHolderName: $validated['card_holder_name'] ?? null,
            description: $validated['description'] ?? null,
            ipAddress: $request->ip(),
            userAgent: $request->userAgent(),
        );
    }
}