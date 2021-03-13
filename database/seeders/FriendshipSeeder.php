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
        Friendship::factory(20)->create();
    }
}
