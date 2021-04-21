<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventUser;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            LocationSeeder::class, //this must be seeded first. Otherwise, the user seeder will have no foreign key(s) to reference.
            UserSeeder::class,
            FriendshipSeeder::class,
            CourtSeeder::class,
            EventSeeder::class,
            EventUserSeeder::class,
            MessageSeeder::class
        ]);
    }
}
