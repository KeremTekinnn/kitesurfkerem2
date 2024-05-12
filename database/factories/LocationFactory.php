<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    protected $model = Location::class;

    public function definition()
    {
        return [
            'meetingplace' => $this->faker->streetName,
            'address' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'googlemapslink' => 'https://www.google.com/maps/place/' . $this->faker->latitude . ',' . $this->faker->longitude,
        ];
    }
}
