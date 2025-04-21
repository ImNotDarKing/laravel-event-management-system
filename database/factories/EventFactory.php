<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'short_description' => $this->faker->text(100),
            'description' => $this->faker->paragraph(),
            'location' => $this->faker->city(),
            'starts_at' => $this->faker->dateTimeBetween('+1 days', '+1 month'),
            'paid' => $this->faker->boolean(30),
            'status' => 'approved',
            'image' => null,
        ];
    }
}
