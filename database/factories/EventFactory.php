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

        $gameStatuses = ['pending', 'cancelled', 'confirmed'];

        return [
            'title' => $this->faker->word,
            'status' => $gameStatuses[$this->faker->numberBetween(0, 2)],
            'date' => $this->faker->date(),
            'time' => $this->faker->time(),
            'host_id' => $this->faker->numberBetween(1, 100),
            'court_id' => $this->faker->numberBetween(1, 20),
            'player_num' => $this->faker->numberBetween(4, 22),
        ];
    }
}
