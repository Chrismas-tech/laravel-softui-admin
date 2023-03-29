<?php

namespace Database\Factories;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public $count = 1;

    public function definition()
    {
        return [
            'amount' => $this->faker->numberBetween(10, 800),
            'invoice_number' => Invoice::all()->count() + 1,
        ];
    }
}
