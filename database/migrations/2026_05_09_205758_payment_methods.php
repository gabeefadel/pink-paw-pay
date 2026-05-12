<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
    public function up(): void
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('description'); // Pix, Credit Card
            $table->boolean('is_active')->default(true);
            $table->json('config')->nullable(); // Ex: {"fee_percentage": 2.99, "max_installments": 12}
            $table->timestamps();
        });
    }

    public function down(): void
    {
        //
    }
};
