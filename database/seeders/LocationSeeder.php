<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Location::factory(10)->create();

        Location::create(['city'=>'Belgrade']);
        Location::create(['city'=>'Novi Sad']);
        Location::create(['city'=>'Cacak']);
        Location::create(['city'=>'Nis']);
        Location::create(['city'=>'Subotica']);
    }
}
