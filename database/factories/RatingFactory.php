<?php

namespace Database\Factories;

use App\Models\Rating;
use Illuminate\Database\Eloquent\Factories\Factory;

class RatingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rating::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $rating = ['positive','neutral','negative'];

        return [
            'rater_id' =>$this->faker->numberBetween(1,100),
            'rated_id'=>$this->faker->unique()->numberBetween(1,100),
            'rating'=>$rating[$this->faker->numberBetween(0,2)],
            'comment'=>'Random comment describing experience.',
        ];
    }
}
