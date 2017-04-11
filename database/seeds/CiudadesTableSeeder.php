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
        $cities = array('MARRUECOS', 'JAPON', 'INDIA', 'ARGENTINA', 'INGLATERRA');
        $ayer = new Carbon('America/Mexico_City');

        for ($i = 0; $i < 5; $i++) {
            $ciudad = new \App\Ciudad();
            $ciudad->name = $cities[$i];
            $ciudad->available = 1;
            $ciudad->publish = $ayer->subHours(6)->addDays($i);
            $ciudad->save();
        }
    }
}
