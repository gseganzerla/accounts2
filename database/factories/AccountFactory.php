<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'username' => $this->faker->userName,
            'password' => $this->faker->password,
            'uuid' => $this->faker->uuid,
            'email' => $this->faker->safeEmail(),
            'account' => $this->faker->word
        ];
    }
}
