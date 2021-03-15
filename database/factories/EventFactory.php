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

        $gameStatuses = ['pending','cancelled','confirmed'];

        //if this if statement returns 1, a premium game will be created (which
        //uses court_id, and not location_id and address). If it returns 0,
        // a free game will be created (which does not have a partner
        // court id, but does have a location_id, and address).

        //If a game does not have a court_id, we know it is not a premium court game,
        //but a free open court game (no user payment required).

        if($this->faker->numberBetween(0,1) === 1){
            return [
                'title'=>$this->faker->word,
                'status'=>$gameStatuses[$this->faker->numberBetween(0,2)],
                'date'=>$this->faker->date(),
                'time'=>$this->faker->time(),
                'host_id'=>$this->faker->numberBetween(1, 100),
                'court_id'=>$this->faker->numberBetween(1,20), //imput
                'location_id'=>null, //null
                'address'=>null, //null
                'player_num'=>$this->faker->numberBetween(4,22),
            ];
        } else {
            return [
                'title'=>$this->faker->word,
                'status'=>$gameStatuses[$this->faker->numberBetween(0,2)],
                'date'=>$this->faker->date(),
                'time'=>$this->faker->time(),
                'host_id'=>$this->faker->numberBetween(1, 100),
                'court_id'=>null, //null
                'location_id'=>$this->faker->numberBetween(1,10), //input
                'address'=>$this->faker->address, //input
                'player_num'=>$this->faker->numberBetween(4,22),
            ];
        }
    }
}
