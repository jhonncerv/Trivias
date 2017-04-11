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

        for($preg = 1; $preg <= 45; $preg++){

            for ($i = 0; $i < 2 ; $i++) {

                $respuesta = new \App\Respuesta();
                $respuesta->option =  $i < 1 ? 'left' : 'right';
                $respuesta->correct = ($preg > 20 ) ?  (( $i < 1) ? 0:1) : (($i > 0)?0:1);
                $respuesta->pregunta_id = $preg;
                $respuesta->save();

            }
        }

        $rep = array(
            ['Desierto del Sahara','Desierto de Erg Chebbi','Duna de Pyla'],
            ['Ave Ibis Eremita','Cocodrilo','Garza Cocol '],
            ['Mezquita Hassan','Al Hikmah','La Torre Eiffel'],
            ['Marruecos','El Rabat','Estonia'],
            ['Tagine','Plato de cerámica','Arte orbe'],
        );

        $res = array(1,1,1,2,1);


        for($preg = 46; $preg <= 50; $preg++){

            for ($i = 0; $i < 3 ; $i++) {

                $respuesta = new \App\Respuesta();
                $respuesta->option = $rep[$preg-46][$i];
                $respuesta->correct = $i == ( $res[$preg-46] - 1 ) ? 1 : 0;
                $respuesta->pregunta_id = $preg;
                $respuesta->save();

            }
        }

        $rep = array(
            [
                'República Soberana de Marruecos',
                'Estado de Marruecos',
                'Reino de Marruecoss'
            ],
            [
                'Cervantes',
                'Paulo Cohelo ',
                'Paul Bowles'
            ],
            [
                'Cruz Roja',
                'Medialuna luminosa',
                'Un corazón'
            ],
            [
                'Gorro de Fez',
                'Balmoral',
                'Beanie'
            ],
            [
                'Cierto',
                'Falso',
                'No sé'
            ]
        );

        $res = array(3,3,2,1,1);


        for($preg = 51; $preg <= 55; $preg++){

            for ($i = 0; $i < 3 ; $i++) {

                $respuesta = new \App\Respuesta();
                $respuesta->option = $rep[$preg-51][$i];
                $respuesta->correct = $i == ( $res[$preg-51] - 1 ) ? 1 : 0;
                $respuesta->pregunta_id = $preg;
                $respuesta->save();

            }
        }

        $res = array(
            '410,105',
            '35,630',
            '625,645'
        );
        $preg = 56;

        for ($i = 0; $i < 3 ; $i++) {

            $respuesta = new \App\Respuesta();
            $respuesta->option = $res[$i];
            $respuesta->correct = 1;
            $respuesta->pregunta_id = $preg;
            $respuesta->save();

        }

    }
}
