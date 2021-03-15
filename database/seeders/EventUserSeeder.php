<?php

namespace Database\Seeders;

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
        EventUser::factory(30)->create();
    }
}
