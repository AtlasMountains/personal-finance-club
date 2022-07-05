<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\TransactionTag;
use App\Models\TransactionType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'amount' => $this->faker->numberBetween(-1000, 1000),
            'recipient' => $this->faker->firstName(),
            'message' => $this->faker->sentence(),
            'date' => $this->faker->dateTimeBetween((now()->startOfYear()), now()),
            'transaction_type_id' => TransactionType::all()->random(),
            'account_id' => Account::all()->random(),
            'transaction_tag_id' => TransactionTag::all()->random(),
        ];
    }
}
