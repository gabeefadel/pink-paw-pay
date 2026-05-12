<?php


namespace Database\Seeders;

use App\Models\PaymentMethods;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    public function run(): void
    {
        PaymentMethods::updateOrCreate(
            ['id' => 1], 
            [
                'description' => 'Pix',
                'is_active' => true,
                'config' => ['fee_percentage' => 0.00] 
            ]
        );

        PaymentMethods::updateOrCreate(
            ['id' => 2],
            [
                'description' => 'Cartão de Crédito',
                'is_active' => true,
                'config' => ['fee_percentage' => 2.99, 'max_installments' => 12]
            ]
        );
    }
}
