<?php

namespace Database\Factories;

use App\Models\CreditTypeModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class CreditTypeModelFactory extends Factory
{
    protected $model = CreditTypeModel::class;

    public function definition()
    {
        return [
            'name' => $this->faker->words(2, true),
            'description' => $this->faker->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
