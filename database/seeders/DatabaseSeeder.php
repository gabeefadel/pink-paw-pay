<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            PaymentMethodSeeder::class,
        ]);

        User::factory()
            ->has(UserAddress::factory(), 'address')
            ->create([
                'name' => 'Gabi Doadora',
                'email' => 'gabi@pinkpaw.com',
            ]);

        User::factory()
            ->blocked()
            ->has(UserAddress::factory(), 'address')
            ->create([
                'name' => 'Tentativa Maliciosa',
                'email' => 'bloqueado@pinkpaw.com',
            ]);
    }
}
