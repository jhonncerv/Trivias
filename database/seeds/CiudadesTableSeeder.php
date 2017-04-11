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
        $hoy = new Carbon('America/Mexico_City');

        $e = 0;
        for ($i = 0; $i < 5; $i++) {
            $ciudad = new \App\Ciudad();
            $ciudad->name = $cities[$i];
            $ciudad->available = 1;
            $ciudad->publish = $hoy->addDays($e);
            $e += ($i > 1) ? 1 : 2;
            $ciudad->save();
        }
    }
}
