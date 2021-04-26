<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Friendship;

class FriendshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //not using a factory because I do not want to risk causing errors

        //creating admin friendship rows
        Friendship::create(['receiver_id' => 1,'requester_id' => 2,'status'=> 'pending']);
        Friendship::create(['receiver_id' => 7,'requester_id' =>1,'status'=> 'pending']);

        Friendship::create(['receiver_id' =>1,'requester_id' => 4,'status'=> 'accepted']);
        Friendship::create(['receiver_id' => 5,'requester_id' =>1,'status'=> 'accepted']);

        Friendship::create(['receiver_id' => 3,'requester_id' =>1,'status'=> 'pending']);
        Friendship::create(['receiver_id' =>6,'requester_id' => 1,'status'=> 'accepted']);
    }
}
