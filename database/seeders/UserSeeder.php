<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'name' => 'Admin Adminovic',
            'age' => 23,
            'sex' => 'male',
            'location_id' => '1',
            'email' => 'admin@admin.com',
            'username' => 'Adminsky',
            'image_url' => 'ZRvfy3XNjnh4NDjmXCjApm8p3M1jsu1JX73IpWrP.jpg',
            'bio'=>'',
            'email_verified_at' => now(),
            'password' => Hash::make('admin1234'), // password
            'remember_token' => Str::random(10),
        ]);


        User::factory(98)->create();

        User::create([
            'name' => 'Admin2 Adminovic2',
            'age' => 25,
            'sex' => 'male',
            'location_id' => '1',
            'email' => 'admin2@admin.com',
            'username' => 'Adminsky2',
            'image_url' => 'ZRvfy3XNjnh4NDjmXCjApm8p3M1jsu1JX73IpWrP.jpg',
            'bio'=>'',
            'email_verified_at' => now(),
            'password' => Hash::make('admin1234'), // password
            'remember_token' => Str::random(10),
        ]);
    }
}
