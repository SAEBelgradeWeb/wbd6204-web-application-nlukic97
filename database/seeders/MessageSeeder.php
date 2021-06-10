<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Message;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $usersIds = [1,2,4,5,7]; //the users that are in the game 1, owned by user 1
        $i = 1;
        while($i < count($usersIds)){

            Message::factory()->create([
                'user_id'=>$usersIds[$i],
                'event_id'=>1,
            ]);

            $i++;
        }
    }
}
