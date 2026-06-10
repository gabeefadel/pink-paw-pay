<?php

namespace App\Services;

use App\Models\User;
use App\DTOs\DonationDTO;
use App\Notifications\AccountBlockedNotification;
use App\Repositories\DonationRepository;
use Illuminate\Support\Facades\DB;

class DonationService
{
    public function __construct(
        private DonationRepository $donationRepo,
        private Audit\MongoAuditLogger $auditLogger
    ) {}

    public function handleDonation(User $user, DonationDTO $dto)
    {
        try {
            // Iniciamos a proteção atômica
            return DB::transaction(function () use ($user, $dto) {
                
                // Simulação de processamento bancário...
                // Se o gateway falhar, jogamos uma Exception proposital
                if ($this->gatewayPaymentFailed()) {
                    throw new \Exception("Pagamento Recusado");
                }

                // Sucesso: Persistência e Limpeza
                $donation = $this->donationRepo->create($dto);
                $user->update(['failed_attempts' => 0]);
                
                return $donation;
            });

        } catch (\Exception $e) {
            // A falha caiu aqui? O DB Transaction já deu ROLLBACK automático.
            $this->handleFailure($user);
            throw $e;
        }
    }

    private function handleFailure(User $user)
    {
        $user->increment('failed_attempts');

        if ($user->failed_attempts >= 3) {
            $user->update([
                'status' => 'blocked',
                'blocked_until' => now()->addMinutes(15)
            ]);

            // Dispara notificação via Queue (imprescindível o 'shouldQueue' na classe)
            $user->notify(new AccountBlockedNotification());
            
            $this->auditLogger->logFailedTransaction('User blocked after 3 attempts', [
                'user_uuid' => $user->uuid
            ]);
        }
    }
}