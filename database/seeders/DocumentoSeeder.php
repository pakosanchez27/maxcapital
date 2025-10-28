<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DocumentModel;

class DocumentoSeeder extends Seeder
{
    public function run(): void
    {
    DocumentModel::factory()->count(20)->create();
    }
}
