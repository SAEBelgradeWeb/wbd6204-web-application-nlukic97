<?php

namespace Database\Factories;

use App\Models\Event;
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
        return [
            'user_id'=>'overridden',
            'event_id'=>'overridden',
        ];
    }
}
