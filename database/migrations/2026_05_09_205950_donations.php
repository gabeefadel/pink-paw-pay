<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->foreignUuid('user_uuid')->constrained('users', 'uuid');
            $table->foreignUuid('payment_user_uuid')->constrained('payment_user_donations', 'uuid');
            $table->foreignId('payment_method_id')->constrained('payment_methods');
            
            $table->decimal('amount', 10, 2);
            $table->decimal('fee_amount', 10, 2)->default(0.00); // Taxa do Gateway (Lucro Real)
            
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded'])->default('pending');
            $table->string('voucher_code')->nullable(); // Regra: Doações > R$ 200,00
            
            $table->timestamp('transaction_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        //
    }
};
