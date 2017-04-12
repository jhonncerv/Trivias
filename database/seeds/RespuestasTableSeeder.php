<?php

use Illuminate\Database\Seeder;

class RespuestasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    /*
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
    */

    public function run(){

        /*
         *
         * Japon trivia 1 - 5
         */
       for($preg = 57; $preg <= 100; $preg++){

            for ($i = 0; $i < 2 ; $i++) {

                $respuesta = new \App\Respuesta();
                $respuesta->option =  $i < 1 ? 'left' : 'right';
                $respuesta->correct = ($preg > 76 ) ?  (( $i < 1) ? 0:1) : (($i > 0)?0:1);
                $respuesta->pregunta_id = $preg;
                $respuesta->save();

            }
        }

        /*
         *
         * Japon triva 2 ~ 6
         */

        $rep = array(
            [
                'Budha',
                'Dalí',
                'Kamakura',
            ],
            [
                'Arco Triunfal',
                'Puera de Torii',
                'Torana',
            ],
            [
                'Machu Picchu',
                'Monte Fuji',
                'Volcan japonés',
            ],
            [
                'Templo de Horyuji',
                'Masaoka Shiki',
                'Reido',
            ],
            [
                'Torre de telecomunicación',
                'Sky building',
                'Tokyo sky tree',
            ],
        );

        $res = array(1,2,2,1,3);


        for($preg = 101; $preg <= 105; $preg++){

            for ($i = 0; $i < 3 ; $i++) {

                $respuesta = new \App\Respuesta();
                $respuesta->option = $rep[$preg-101][$i];
                $respuesta->correct = $i == ( $res[$preg-101] - 1 ) ? 1 : 0;
                $respuesta->pregunta_id = $preg;
                $respuesta->save();

            }
        }

        /*
         *
         * Japon 3 ~ 7
         */

        $rep = array(
            [
                '50,000',
                '100',
                '174,000'
            ],
            [
                'Tomar una ducha',
                'Dormir en el trabajo',
                'Hacer ejercicio por 20 minutos'
            ],
            [
                'Cierto',
                'Falso',
                'No sé'
            ],
            [
                'Tomar té',
                'Medianoche',
                'Rezar'
            ],
            [
                'Triangulares',
                'Redondas',
                'Cuadradas'
            ]

        );

        $res = array(1,2,1,2,3);

        for($preg = 106; $preg <= 110; $preg++){

            for ($i = 0; $i < 3 ; $i++) {

                $respuesta = new \App\Respuesta();
                $respuesta->option = $rep[$preg-106][$i];
                $respuesta->correct = $i == ( $res[$preg-106] - 1 ) ? 1 : 0;
                $respuesta->pregunta_id = $preg;
                $respuesta->save();

            }
        }


        /*
         *
         * Japon 4 ~8
         */


        $res = array(
            '520,100',
            '65,485',
            '495,580'
        );
        $preg = 111;

        for ($i = 0; $i < 3 ; $i++) {

            $respuesta = new \App\Respuesta();
            $respuesta->option = $res[$i];
            $respuesta->correct = 1;
            $respuesta->pregunta_id = $preg;
            $respuesta->save();

        }


    }

}