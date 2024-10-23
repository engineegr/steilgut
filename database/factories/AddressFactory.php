<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'google_place_id' => Str::uuid(),
            'full_path' => $this->faker->address,
            'country' => $this->faker->country,
            'city' => $this->faker->city,
            'street' => $this->faker->streetName,
            'zip_code' => $this->faker->postcode,
            'building_number' => $this->faker->buildingNumber,
        ];
    }
}
