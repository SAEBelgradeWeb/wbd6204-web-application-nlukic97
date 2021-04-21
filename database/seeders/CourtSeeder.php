<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Court;

class CourtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Court::factory(20)->create();


        Court::create(['title' => 'Bronze court','address'=>'Address1','location_id'=>1,'price'=>20]);
        Court::create(['title' => 'Silver court','address'=>'Address2','location_id'=>1,'price'=>60]);
        Court::create(['title' => 'Gold court','address'=>'Address3','location_id'=>1,'price'=>100]);

        Court::create(['title' => 'Bronze court','address'=>'Address1','location_id'=>2,'price'=>20]);
        Court::create(['title' => 'Silver court','address'=>'Address2','location_id'=>2,'price'=>60]);
        Court::create(['title' => 'Gold court','address'=>'Address3','location_id'=>2,'price'=>100]);

        Court::create(['title' => 'Bronze court','address'=>'Address1','location_id'=>3,'price'=>20]);
        Court::create(['title' => 'Silver court','address'=>'Address2','location_id'=>3,'price'=>60]);
        Court::create(['title' => 'Gold court','address'=>'Address3','location_id'=>3,'price'=>100]);

        Court::create(['title' => 'Bronze court','address'=>'Address1','location_id'=>4,'price'=>20]);
        Court::create(['title' => 'Silver court','address'=>'Address2','location_id'=>4,'price'=>60]);
        Court::create(['title' => 'Gold court','address'=>'Address3','location_id'=>4,'price'=>100]);

        Court::create(['title' => 'Bronze court','address'=>'Address1','location_id'=>5,'price'=>20]);
        Court::create(['title' => 'Bronze court','address'=>'Address2','location_id'=>5,'price'=>60]);
        Court::create(['title' => 'Gold court','address'=>'Address3','location_id'=>5,'price'=>100]);


    }
}
