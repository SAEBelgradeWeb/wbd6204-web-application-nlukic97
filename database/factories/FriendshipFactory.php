<?php

namespace Database\Factories;

use App\Models\Friendship;
use Illuminate\Database\Eloquent\Factories\Factory;

class FriendshipFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Friendship::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $options = ['pending','accepted','denied'];

        $num1 = $this->faker->numberBetween(0,100);
        $num2= $this->faker->numberBetween(0,100);
        while($num2 === $num1){
            $num2 = $this->faker->numberBetween(0,100);
        }

        return [
            'receiver_id' => $num2,
            'requester_id' => $num1,
            'status'=> $options[$this->faker->numberBetween(0,2)],
        ];
    }
}
