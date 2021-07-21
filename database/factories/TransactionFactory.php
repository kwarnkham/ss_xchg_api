<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amount' => 1000,
            'type' => $this->faker->numberBetween(0, 1),
            'rate' => 0.03,
            'fees' => 1000 * 0.03 / 100,
            'net' => 1000
        ];
    }
}
