<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Models\EventNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class EventStatusUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:event-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "This command will check all games that are 6 hours (or less) from being played.
    It will cancel games with not enough users,
    and will confirm games that are full.";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->runChecker();
    }

    //Timeframe for making updates on a game (within x hours of gameplay time, the updator will run)
    protected $hours = 6;


    public function runChecker(){
        $events = Event::where('status','created')->get();

        foreach ($events as $event) {
            $eventTimestamp = Carbon::parse("$event->date $event->time")->getTimestamp();
            $currTimestamp = Carbon::now()->getTimestamp();

            //if the difference between the timestamps are less than 6 hours for each game
            if(($eventTimestamp - $currTimestamp) <= ($this->hours *60*60)){
                $this->checkPlayerCount($event);
            }
        }
    }


    public function checkPlayerCount($event){
        if(count($event->users) < $event->player_num){
            $this->updateEventStatus($event,'cancelled'); //cancel event
        } else {
            $this->updateEventStatus($event,'confirmed'); //confirm event
        }
    }


    public function updateEventStatus($event,$status){
        $event->update([
            'status'=>$status
        ]);
        $this->sendNotifications($event,$status);
    }

    public function sendNotifications($event,$status){
        foreach ($event->users as $user){
            EventNotification::create([
                'receiver_id'=>$user->id,
                'event_id'=>$event->id,
                'type'=>$status
            ]);
        }

        Log::info('Izvrseno');
    }



}
