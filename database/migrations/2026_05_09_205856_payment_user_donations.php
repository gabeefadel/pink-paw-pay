<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('payment_user_donations', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->foreignUuid('user_uuid')->constrained('users', 'uuid');
            $table->foreignId('payment_method_id')->constrained('payment_methods');
            
            $table->string('transaction_code')->unique();
            $table->string('session_id')->nullable(); // Link para logs no MongoDB
            $table->ipAddress('ip_address');
            $table->text('user_agent');
            
            // Dados sensíveis: Payload completo criptografado (AES-256)
            $table->text('encrypted_payload'); 
            
            // Dados para exibição segura (Masking)
            $table->string('card_last_four', 4)->nullable();
            $table->string('card_brand')->nullable();
            
            // Controle de Ciclo de Vida
            $table->boolean('is_processed')->default(false);
            $table->timestamp('expires_at'); // Para o Cleanup Job (Senior Practice)
            
            $table->timestamps();
        });
    }

  
    public function down(): void
    {
        //
    }
};
