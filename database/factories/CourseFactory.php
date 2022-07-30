<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->title(),
            'description' => fake()->paragraph(),
            'price' => 100,
            'start_date' => '2022-08-10',
            'end_date' => '2022-08-30',
            'subscribers_quantity' => 32,
            'current_subscribers' => 0,
            'file_name' => '/storage/files/Arquivo.pdf'
        ];
    }
}
