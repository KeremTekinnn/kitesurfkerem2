<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomNumber(2),
            'duration' => $this->faker->randomFloat(2, 1, 5),
            'max_persons' => $this->faker->randomNumber(2),
        ];
    }
}
