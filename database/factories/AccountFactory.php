<?php

namespace Database\Factories;

use App\Models\AccountType;
use App\Models\Family;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
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
            'name' => $this->faker->word(),
            'user_id' => User::all()->random(),
            'account_type_id' => AccountType::all()->random(),
            'family_id' => Family::all()->random(),
            'start_balance' => $this->faker->numberBetween(0, 734623),
            'alert' => $this->faker->numberBetween(0, 5000),
        ];
    }
}
