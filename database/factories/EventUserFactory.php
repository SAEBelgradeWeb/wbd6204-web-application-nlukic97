<?php

namespace Database\Factories;

use App\Models\EventUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EventUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $statuses = ['pending','accepted','rejected']; //I might remove this feature, users can simply join any game

        return [
            'user_id'=>$this->faker->unique()->numberBetween(1,100),
            'event_id'=>$this->faker->numberBetween(1, 10),
            'status'=>$statuses[$this->faker->numberBetween(0,2)],
        ];
    }
}
