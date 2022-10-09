<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $teacher_id_arr = Teacher::pluck('id')->toArray();
        return [
            'name' => $this->faker->name,
            'age' => $this->faker->numberBetween(10, 40),
            'gender' => $this->faker->randomElement(['m','f','o']),
            'teacher_id' => $this->faker->randomElement($teacher_id_arr),
        ];
    }
}
