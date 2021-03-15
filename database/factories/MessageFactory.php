<?php

namespace Database\Factories;

use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\EventUser;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
//        $eventUser = EventUser::find($this->faker->numberBetween(1,30));
        $eventUser = EventUser::where('status','accepted')->get();
        $num = count($eventUser);
        return [
            'message'=>$this->faker->sentence,
            'event_id'=>$eventUser[$this->faker->numberBetween(0,$num-1)]->event_id,
            'user_id'=>$eventUser[$this->faker->numberBetween(0,$num-1)]->user_id,
        ];
    }
}
