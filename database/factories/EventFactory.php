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

        $gameStatuses = ['pending','created','cancelled','confirmed'];
        $day = $this->faker->numberBetween(1,29);

        return [
            'title' => $this->faker->catchPhrase,
            'status' => $gameStatuses[$this->faker->numberBetween(1, 3)],
            'date' => $this->faker->date("2021-05-{$day}"),
            'time' => $this->faker->time(),
            'host_id' => $this->faker->numberBetween(2, 10),
            'court_id' => $this->faker->numberBetween(1, 15),
            'player_num' => $this->faker->numberBetween(4, 12),
            'timestamp'=>time()
        ];
    }
}
