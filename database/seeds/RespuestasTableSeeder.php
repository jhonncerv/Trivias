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
       /*for($preg = 57; $preg <= 100; $preg++){

            for ($i = 0; $i < 2 ; $i++) {

                $respuesta = new \App\Respuesta();
                $respuesta->option =  $i < 1 ? 'left' : 'right';
                $respuesta->correct = ($preg > 76 ) ?  (( $i < 1) ? 0:1) : (($i > 0)?0:1);
                $respuesta->pregunta_id = $preg;
                $respuesta->save();

            }
        }*/

        /*
         *
         * Japon triva 2 ~ 6
         */

       /* $rep = array(
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
        }*/

        /*
         *
         * Japon 3 ~ 7
         */
/*
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
*/

        /*
         *
         * Japon 4 ~8
         */


   /*     $res = array(
            '520,50',
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
*/

        /*
           *
           * india trivia 1 - 9
           */
/*
        for($preg = 112; $preg <= 156; $preg++){

            for ($i = 0; $i < 2 ; $i++) {

                $respuesta = new \App\Respuesta();
                $respuesta->option =  $i < 1 ? 'left' : 'right';
                $respuesta->correct = ($preg > 131 ) ?  (( $i < 1) ? 0:1) : (($i > 0)?0:1);
                $respuesta->pregunta_id = $preg;
                $respuesta->save();

            }
        }*/

        /*
         *
         * India triva 2 ~ 10
         */
/*
        $rep = array(
            [
                'Gandhi',
                'Casa Blanca',
                'Taj Mahal',
            ],
            [
                'Templo de Loto',
                'Templo de Dios',
                'Templo de Delhi',
            ],
            [
                'Puerta de Alcalá',
                'Puerta de la India',
                'Puerta al cielo',
            ],
            [
                'Halcones',
                'Elefantes',
                'Leones ',
            ],
            [
                'Mandala',
                'Cruz blanca',
                'Círculo sagrado',
            ],
        );

        $res = array(3,1,2,2,1);


        for($preg = 157; $preg <= 161; $preg++){

            for ($i = 0; $i < 3 ; $i++) {

                $respuesta = new \App\Respuesta();
                $respuesta->option = $rep[$preg-157][$i];
                $respuesta->correct = $i == ( $res[$preg-157] - 1 ) ? 1 : 0;
                $respuesta->pregunta_id = $preg;
                $respuesta->save();

            }
        }
*/
        /*
         *
         * india 3 ~ 11
         */
/*
        $rep = array(
            [
                '1,200 millones de habitantes',
                '150 millones de habitantes ',
                '2,300 millones de habitantes ',
            ],
            [
                'Dalai Lama',
                'Sadhus',
                'Monjes Iluminados',
            ],
            [
                'Elefante',
                'Gallo',
                'Vaca',
            ],
            [
                'Cierto ',
                'Falso ',
                'No sé',
            ],
            [
                'Río Sagrado',
                'Río Ganges',
                'Río Rojo',
            ]

        );

        $res = array(1,2,3,1,2);

        for($preg = 162; $preg <= 166; $preg++){

            for ($i = 0; $i < 3 ; $i++) {

                $respuesta = new \App\Respuesta();
                $respuesta->option = $rep[$preg-162][$i];
                $respuesta->correct = $i == ( $res[$preg-162] - 1 ) ? 1 : 0;
                $respuesta->pregunta_id = $preg;
                $respuesta->save();

            }
        }
*/

        /*
         *
         * India 4 ~ 12
         *  945,40
         *  130, 320
         *  50, 1300
         *  750, 1400
         */

/*
        $res = array(
            '472,20',
            '65,160',
            '25,650',
            '375,700',
        );
        $preg = 167;

        for ($i = 0; $i < 4 ; $i++) {

            $respuesta = new \App\Respuesta();
            $respuesta->option = $res[$i];
            $respuesta->correct = 1;
            $respuesta->pregunta_id = $preg;
            $respuesta->save();

        }
*/
        /*
         *
         * Srgentina trivia 1 - 13
         */

        for($preg = 168; $preg <= 212; $preg++){

            for ($i = 0; $i < 2 ; $i++) {

                $respuesta = new \App\Respuesta();
                $respuesta->option =  $i < 1 ? 'left' : 'right';
                $respuesta->correct = ($preg > 187 ) ?  (( $i < 1) ? 0:1) : (($i > 0)?0:1);
                $respuesta->pregunta_id = $preg;
                $respuesta->save();

            }
        }


        /*
         *
         * Argentina triva 2 ~ 14
         */

                $rep = array(
                    [
                        'Casa Rosa',
                        'Obelisco ',
                        'Maradonna  ',
                    ],
                    [
                        'Faro de Oriente',
                        'Faro en Ushuaia',
                        'Faro de San Juan de Salvamento',
                    ],
                    [
                        'Vals',
                        'Tango ',
                        'Soul ',
                    ],
                    [
                        'Museo Histórico Nacional del Cabildo y la Revolución de Mayo',
                        'Museo Nacional de Argentina ',
                        'Museo de la ciudad de Buenos Aires',
                    ],
                    [
                        'Torre de Jesús ',
                        ' La Catedral de la Plata',
                        'Catedral de Nuestra Señora de la Concepción',
                    ],
                );

                $res = array(2,3,2,1,2);


                for($preg = 213; $preg <= 217; $preg++){

                    for ($i = 0; $i < 3 ; $i++) {

                        $respuesta = new \App\Respuesta();
                        $respuesta->option = $rep[$preg-213][$i];
                        $respuesta->correct = $i == ( $res[$preg-213] - 1 ) ? 1 : 0;
                        $respuesta->pregunta_id = $preg;
                        $respuesta->save();

                    }
                }
        /*
           *
           * india 3 ~ 11
           */

            $rep = array(
                [
                    'Física',
                    'Historia',
                    'Química',
                ],
                [
                    'Dulces de leche',
                    'Alfajores',
                    'Pay de manzana',
                ],
                [
                    'El Rio de la Plata',
                    'Rio Misisipi',
                    'Rio Amazonas',
                ],
                [
                    'Mario Alberto Kempes',
                    'Hernán Crespo',
                    'Gabriel Omar Batistuta',
                ],
                [
                    'Casa Rosa',
                    'Muro de Berlin',
                    'Las Cataratas de Iguazú',
                ]

            );

                $res = array(3,2,1,3,3);

                for($preg = 218; $preg <= 222; $preg++){

                    for ($i = 0; $i < 3 ; $i++) {

                        $respuesta = new \App\Respuesta();
                        $respuesta->option = $rep[$preg-218][$i];
                        $respuesta->correct = $i == ( $res[$preg-218] - 1 ) ? 1 : 0;
                        $respuesta->pregunta_id = $preg;
                        $respuesta->save();

                    }
                }

        /*
         *
         * Argentina 4 ~ 16
         *  30,1100
         *  140,800
         * 1210,1075
         *
         */


        $res = array(
            '15,550',
            '70,400',
            '605,536',
        );
        $preg = 223;

        for ($i = 0; $i < 3 ; $i++) {

            $respuesta = new \App\Respuesta();
            $respuesta->option = $res[$i];
            $respuesta->correct = 1;
            $respuesta->pregunta_id = $preg;
            $respuesta->save();

        }

        /*
         *
         * Inglatera 4 ~
         *  260,300
         *  920,85
         *  1286,922
         *  664,1434
         */

/*
        $res = array(
            '130,150',
            '460,43',
            '643,461',
            '332,717',
        );
        $preg = 111;

        for ($i = 0; $i < 4 ; $i++) {

            $respuesta = new \App\Respuesta();
            $respuesta->option = $res[$i];
            $respuesta->correct = 1;
            $respuesta->pregunta_id = $preg;
            $respuesta->save();

        }
*/

    }

}