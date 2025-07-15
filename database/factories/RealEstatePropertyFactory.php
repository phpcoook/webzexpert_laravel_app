<?php

namespace Database\Factories;

use App\Models\RealEstateProperty;
use Illuminate\Database\Eloquent\Factories\Factory;

class RealEstatePropertyFactory extends Factory
{
    protected $model = RealEstateProperty::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'real_estate_type' => $this->faker->randomElement(['house', 'land', 'department', 'commercial_ground']),
            'street' => $this->faker->streetName(),
            'external_number' => $this->faker->bothify('##?-??'),
            'internal_number' => $this->faker->optional()->bothify('Unit ##'),
            'neighborhood' => $this->faker->word(),
            'city' => $this->faker->city(),
            'country' => $this->faker->countryCode(),
            'rooms' => $this->faker->numberBetween(0, 5),
            'bathrooms' => $this->faker->randomFloat(1, 0, 3),
            'comments' => $this->faker->optional()->sentence(),
        ];
    }
}

