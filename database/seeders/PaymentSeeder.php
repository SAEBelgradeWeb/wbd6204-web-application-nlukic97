<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\EventUser;
use App\Models\Event;
use App\Models\Court;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $event = Event::where('court_id','!=','null')->first();
        $court = Court::find($event->court_id);
        $eventUser = EventUser::where('event_id',$event->id)->first();

        DB::table('payments')->insert([
            'user_id' => $eventUser->user_id,
            'event_id' => $eventUser->event_id,
            'amount' => $court->price / $event->player_num, //($event->price / $event->player_num)
            'description' => 'User has paid the amount to play',
        ]);

        $event2 = Event::where('court_id','!=','null')->get()[1];
        $court2 = Court::find($event2->court_id);
        $eventUser2 = EventUser::where('event_id',$event2->id)->first();
        $amount = $court2->price / $event2->player_num;

        DB::table('payments')->insert([
            'user_id' => $eventUser2->user_id,
            'event_id' => $eventUser2->event_id,
            'amount' => $amount,
            'description' => 'User has paid the amount to play',
        ]);

        $amountRefunded = -$amount;

        DB::table('payments')->insert([
            'user_id' => $eventUser2->user_id,
            'event_id' => $eventUser2->event_id,
            'amount' => $amountRefunded,
            'description' => 'User has been refunded the amount to play',
        ]);
    }
}
