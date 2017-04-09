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

        $Cnow = Carbon::now('America/Mexico_City');
        Carbon::setTestNow($Cnow);

        $cities = array('MARRUECOS', 'ARGENTINA', 'INDIA', 'INGLATERRA, JAPON');

        for ($i = 0; $i < 5; $i++) {
            $ciudad = new \App\Ciudad();
            $ciudad->name = $cities[$i];
            $ciudad->publish = new Carbon('yesterday');
            $ciudad->expiration = new Carbon('next wednesday');
            $ciudad->save();
        }
    }
}
