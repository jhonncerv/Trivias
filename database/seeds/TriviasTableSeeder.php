<?php

use Illuminate\Database\Seeder;
use \Carbon\Carbon;

class TriviasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $trivias = array('twinder', 'siluetas','trivia', 'findings');
        $Cnow = Carbon::now();
        Carbon::setTestNow($Cnow);

        for ($i = 0; $i < 4; $i++) {
            $trivia = new \App\Trivia();
            $trivia->game = $trivias[$i];
            $trivia->points_per_anwser = $faker->numberBetween($min = 1, $max = 10) * 10;
            $trivia->available = $i == 3 ? 0 : 1;
            $trivia->time_limit = ( 20 * 60 );
            $trivia->query_size = 5;
            $trivia->publish = new Carbon('yesterday');
            $trivia->save();
        }

    }
}
