<?php

use Illuminate\Database\Seeder;
use \Carbon\Carbon;

class CiudadesTableSeeder extends Seeder
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
            $ciudad = new \App\Ciudad();
            $ciudad->name = $faker->country;
            $ciudad->publish = new Carbon('yesterday');
            $ciudad->expiration = new Carbon('next wednesday');
            $ciudad->save();
        }
    }
}
