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

        $Cnow = Carbon::now();
        Carbon::setTestNow($Cnow);

        for ($i = 0; $i < 5; $i++) {
            $trivia = new \App\Trivia();
            $trivia->game = $faker->word;
            $trivia->description = $faker->sentence;
            $trivia->points_per_anwser = $faker->numberBetween($min = 10, $max = 100);
            $trivia->punish_per_second = $faker->numberBetween($min = 1, $max = 10);
            $trivia->time_limit = (2 * 60 * 1000);
            $trivia->query_size = 4;
            $trivia->publish = new Carbon('yesterday');
            $trivia->expiration = new Carbon('next wednesday');
            $trivia->save();
        }

    }
}
