<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->words(3, true),
            'main_img' => 'images/postcard_phone_poster-750x435.jpg',
            'preview_img' => 'images/preview_postcard_phone_poster-750x435.jpg',
            'group_id' => $this->faker->numberBetween(1, 5)
        ];
    }
}
