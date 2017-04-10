<?php

use Illuminate\Database\Seeder;

class RespuestasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //$faker = Faker\Factory::create();
        //$faker->word

        $rep = array(
            ['Mezquita Hassan','Al Hikmah','La Torre Eiffel '],
            ['Marruecos','El Rabat','Estonia'],
            ['Desierto del Sahara','Desierto de Erg Chebbi','Duna de Pyla'],
            ['Ave Ibis Eremita','Cocodrilo','Garza Cocol '],
            ['Tagine','Plato de cerámica','Arte orbe'],
        );

        $res = array(1,2,2,1,1);


        for($preg = 21; $preg <= 25; $preg++){

            for ($i = 0; $i < 3 ; $i++) {

                    $respuesta = new \App\Respuesta();
                    $respuesta->option = $rep[$preg-21][$i];
                    $respuesta->correct = $i == ( $res[$preg-21] - 1 ) ? 1 : 0;
                    $respuesta->pregunta_id = $preg;
                    $respuesta->save();

                }
            }

    }
}
