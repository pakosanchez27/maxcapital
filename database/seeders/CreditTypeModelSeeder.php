<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CreditTypeModel;

class CreditTypeModelSeeder extends Seeder
{
    public function run(): void
    {
        CreditTypeModel::factory()->count(10)->create();
    }
}
