<?php

namespace App\Http\Controllers\Donation;

use DTOS\DonationDTO;
use Exception;
use Illuminate\Http\JsonResponse;
use Requests\StoreDonationRequest;
use Services\DonationService;

class DonationController
{
    private $donationService;

    public function __construct()
    {
        $donationService = new DonationService;
    }

    public function store(StoreDonationRequest $request): JsonResponse
    {
        try {

            $dto = DonationDTO::fromRequest($request);
            $donation = $this->donationService->donate(
                $request->user(),
                $dto
            );

            return response()->json([
                'message' => 'Doação processada com sucesso!',
                'donation_id' => $donation->uuid,
            ], 201);

        } catch (Exception $e) {
            return response->json($e, 400);
        }
    }
}
