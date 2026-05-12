<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
       Schema::create('users', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('document')->unique();
            $table->string('phone'); // Para notificações e 2FA
            $table->enum('role', ['donor', 'admin'])->default('donor');
            $table->string('status')->default('active');
            
            // Regra de Segurança: Bloqueio após 3 falhas
            $table->integer('failed_attempts')->default(0);
            $table->timestamp('blocked_until')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        //
    }
};
