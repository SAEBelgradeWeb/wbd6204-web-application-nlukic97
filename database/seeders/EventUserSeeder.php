<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use App\Models\EventUser;

class EventUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 1;
        while($i < count(Event::all())){
            $event = Event::find($i);

            EventUser::factory()->create([
                'user_id'=>$event->host_id,
                'event_id'=>$event->id
            ]);
            $i++;
        }

        $adminEventId = Event::firstWhere('host_id',1)->id; //it will be 1

        EventUser::factory()->create(['user_id'=>7,'event_id'=>$adminEventId]);
        EventUser::factory()->create(['user_id'=>2,'event_id'=>$adminEventId]);
        EventUser::factory()->create(['user_id'=>5,'event_id'=>$adminEventId]);
        EventUser::factory()->create(['user_id'=>4,'event_id'=>$adminEventId]);
    }
}
