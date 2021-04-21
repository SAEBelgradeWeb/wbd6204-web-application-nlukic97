<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //creating admin's event
        Event::create([
            'title' => 'Admin\'s event',
            'status' => 'created',
            'date' => "2021-06-28",
            'time' =>'16:00',
            'host_id' => 1,
            'court_id' => 1,
            'player_num' => 6,
            'timestamp'=>time()
        ]);

        Event::factory(9)->create();
    }
}
