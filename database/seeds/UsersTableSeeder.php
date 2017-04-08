<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        $user = new \App\User();
        $user->name = 'Jhonn';
        $user->email = 'jhonncerv@gmail.com';
        $user->password = bcrypt('qwe123');
        $user->save();
        */

        $user = new \App\User();
        $user->name = 'Admin';
        $user->email = 'admin@gmail.com';
        $user->password = bcrypt('qwe123');
        $user->save();

        $Cnow = Carbon::now();
        Carbon::setTestNow($Cnow);

        $trivia = new \App\Trivia();
        $trivia->game = 'Juego 1';
        $trivia->description = 'Descripcion 1';
        $trivia->points_per_anwser = 50;
        $trivia->punish_per_second = 1;
        $trivia->time_limit = (2 * 60 * 1000);
        $trivia->query_size = 4;
        $trivia->availability = new Carbon('yesterday');
        $trivia->expiration = new Carbon('next wednesday');
        $trivia->save();


    }
}
