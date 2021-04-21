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

        Friendship::create(['receiver_id' => 1,'requester_id' => 2,'status'=> 'pending']);
        Friendship::create(['receiver_id' => 3,'requester_id' =>1,'status'=> 'pending']);

        Friendship::create(['receiver_id' =>1,'requester_id' => 4,'status'=> 'accepted']);
        Friendship::create(['receiver_id' => 5,'requester_id' =>1,'status'=> 'accepted']);

        Friendship::create(['receiver_id' =>1,'requester_id' => 6,'status'=> 'denied']);
        Friendship::create(['receiver_id' => 7,'requester_id' =>1,'status'=> 'denied']);
    }
}
