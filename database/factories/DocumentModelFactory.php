<?php

namespace Database\Factories;

use App\Models\DocumentModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentModelFactory extends Factory
{
    protected $model = DocumentModel::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->words(2, true),
            'descripcion' => $this->faker->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
