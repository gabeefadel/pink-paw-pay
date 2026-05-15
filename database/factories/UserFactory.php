<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'uuid' => Str::uuid(),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => bcrypt('password'),
            'document' => fake()->unique()->numerify('###########'),
            'phone' => fake()->phoneNumber(),
            'role' => 'donor',
            'status' => 'active',
            'failed_attempts' => 0,
            'blocked_until' => null,
        ];
    }

    public function blocked(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'blocked',
            'failed_attempts' => 3,
            'blocked_until' => now()->addMinutes(15),
        ]);
    }
}
