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
        Friendship::factory(50)->create();

//        Friendship::create(['receiver_id' => 20,'requester_id' => 1,'status'=> 'pending']);
//        Friendship::create(['receiver_id' => 2,'requester_id' => 20,'status'=> 'pending']);
//        Friendship::create(['receiver_id' => 20,'requester_id' => 3,'status'=> 'accepted']);
//        Friendship::create(['receiver_id' => 4,'requester_id' => 20,'status'=> 'accepted']);
//        Friendship::create(['receiver_id' => 20,'requester_id' => 6,'status'=> 'denied']);
//        Friendship::create(['receiver_id' => 6,'requester_id' => 20,'status'=> 'denied']);
    }
}
