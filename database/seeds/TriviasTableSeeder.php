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
        $trivias = array('twinder', 'siluetas','trivia', 'finding');
        $puntos = array(40, 30, 20, 50);
        $Cnow = Carbon::now();
        Carbon::setTestNow($Cnow);

        for ($i = 0; $i < 4; $i++) {
            $trivia = new \App\Trivia();
            $trivia->game = $trivias[$i];
            $trivia->points_per_anwser = $puntos[$i];
            $trivia->available = 1;
            if( $i == 0 ){
                $time = 5;
            } else if( $i == 1) {
                $time = 4;
            } else if( $i == 2) {
                $time = 2;
            } else {
                $time = 10;
            }

            $trivia->time_limit = ( $time * 60 );
            $trivia->query_size = $i == 3 ? 1 : 5;
            $trivia->publish = new Carbon('yesterday');
            $trivia->save();
        }

        for ($i = 0; $i < 4; $i++) {
            $trivia = new \App\Trivia();
            $trivia->game = $trivias[$i];
            $trivia->points_per_anwser = $puntos[$i];
            $trivia->available = 1;
            if( $i == 0 ){
                $time = 5;
            } else if( $i == 1) {
                $time = 4;
            } else if( $i == 2) {
                $time = 2;
            } else {
                $time = 10;
            }

            $trivia->time_limit = ( $time * 60 );
            $trivia->query_size = $i == 3 ? 1 : 5;
            $trivia->publish = new Carbon('yesterday');
            $trivia->save();
        }
    }
}
