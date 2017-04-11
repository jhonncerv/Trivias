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

        $cities = array('MARRUECOS', 'ARGENTINA', 'INDIA', 'INGLATERRA', 'JAPON');
        $ayer = new Carbon('America/Mexico_City');

        for ($i = 0; $i < 5; $i++) {
            $ciudad = new \App\Ciudad();
            $ciudad->name = $cities[$i];
            $ciudad->available = $i > 0 ? 0 : 1;
            $ciudad->publish = $ayer->addDays( $i - 1);
            $ciudad->save();
        }
    }
}
