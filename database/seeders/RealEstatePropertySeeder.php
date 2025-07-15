<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RealEstateProperty;

class RealEstatePropertySeeder extends Seeder
{
    public function run(): void
    {
        RealEstateProperty::factory()->count(20)->create();
    }
}
