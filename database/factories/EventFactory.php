<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'place' => $this->faker->address(),
            'location' => $this->faker->title(),
            'image' => null,
            'status' => rand(0, 1),
            'date_start' => Carbon::now()->toDateString(),
            'time_start' => Carbon::now()->toTimeString(),
            'date_end' => Carbon::now()->toDateString(),
            'time_end' => Carbon::now()->toTimeString(),
            'participants' => rand(1, 50),
            'visibility' => rand(0, 1)
        ];
    }
}
