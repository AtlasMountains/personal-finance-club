<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Category;
use App\Models\Type;
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
    public function definition(): array
    {
        $type = Type::all()->random();
        switch ($type->id) {
            case 1: // deposit
                $amount = $this->faker->numberBetween(0, 100000) / 100;
                break;

            case 2: //withdrawal
                $amount = $this->faker->numberBetween(-100000, 0) / 100;
                break;

            default: //transfer
                $amount = $this->faker->numberBetween(-100000, 100000) / 100;
                break;
        }
        $account = Account::all()->random();
        $tag = null;
        if ($account->user->Tags->isNotEmpty()) {
            $tag = $account->user->Tags->random();
        }

        return [
            'amount' => $amount,
            'recipient' => $this->faker->firstName(),
            'message' => $this->faker->sentence(4),
            'date' => $this->faker->dateTimeBetween((now()->subYears(2)), now()),
            'type_id' => $type,
            'account_id' => $account,
            'category_id' => Category::all()->random(),
            'tag_id' => $tag?->id,
        ];
    }
}
