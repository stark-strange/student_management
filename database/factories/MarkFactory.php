<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\Term;
use Illuminate\Database\Eloquent\Factories\Factory;

class MarkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $term_id_arr = Term::pluck('id')->toArray();
        $student_id_arr = Student::pluck('id')->toArray();
        return [
            'maths' => $this->faker->randomDigit,
            'science' => $this->faker->randomDigit,
            'history' => $this->faker->randomDigit,
            'term_id' => $this->faker->randomElement($term_id_arr),
            'student_id' => $this->faker->randomElement($student_id_arr)
        ];
    }
}
