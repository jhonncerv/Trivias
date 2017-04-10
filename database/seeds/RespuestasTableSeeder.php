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


        $rep = array(
            ['República Soberana de Marruecos','Estado de Marruecos','Reino de Marruecos'],
            ['Cervantes de Saavedra','Paulo Cohelo ','Paul Bowles'],
            ['Cruz Roja','Medialuna luminosa','Un corazón'],
            ['Gorro de Fez','Balmoral','Beanie'],
            ['Cierto','Falso','No sé']
        );

        $res = array(3,3,2,1,1);


        for($preg = 0; $preg <= 4; $preg++){

            for ($i = 0; $i < 3 ; $i++) {

                $respuesta = new \App\Respuesta();
                $respuesta->option = $rep[$preg][$i];
                $respuesta->correct = $i == ( $res[$preg] -1 ) ? 1 : 0;
                $respuesta->pregunta_id = $preg+1;
                $respuesta->save();

            }
        }


        $rep = array(
            ['Mezquita Hassan','Al Hikmah','La Torre Eiffel'],
            ['Marruecos','El Rabat','Estonia'],
            ['Desierto del Sahara','Desierto de Erg Chebbi','Duna de Pyla'],
            ['Ave Ibis Eremita','Cocodrilo','Garza Cocol '],
            ['Tagine','Plato de cerámica','Arte orbe'],
        );

        $res = array(1,2,2,1,1);


        for($preg = 6; $preg <= 10; $preg++){

            for ($i = 0; $i < 3 ; $i++) {

                    $respuesta = new \App\Respuesta();
                    $respuesta->option = $rep[$preg-6][$i];
                    $respuesta->correct = $i == ( $res[$preg-6] - 1 ) ? 1 : 0;
                    $respuesta->pregunta_id = $preg;
                    $respuesta->save();

            }
        }

    }
}
