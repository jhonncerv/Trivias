<?php

use Illuminate\Database\Seeder;

class PreguntasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
/*    public function run()
    {

        for($ii = 1; $ii <= 3; $ii++){
            if($ii == 2){
                $pre = 'siluetas/';

                $imagenes = array('Desierto.gif', 'IbisEremita.gif', 'Mezquita-Hassan.gif', 'Rabat.gif', 'Tajin.gif');
                $caption = array(
                    'Este lugar es hermoso para recorrerlo en camello:',
                    'Es una de las especies más amenazadas del mundo:',
                    'Éste es el templo más alto del mundo y se encuentra en Marruecos:',
                    'Es la capital del Reino de Marruecos:',
                    'Es un utencilio clásico para los alimentos de los marroquis:'
                );

                for($i=0;$i<5;$i++){

                    $pregunta = new \App\Pregunta();
                    $pregunta->question = $pre.$imagenes[$i];
                    $pregunta->caption = $caption[$i];
                    $pregunta->trivia_id = $ii;
                    $pregunta->save();
                }

            } else if($ii == 3) {


                $preguntas = array(
                    'EL nombre oficial de Marruecos:',
                    'El ritual del té está descrito en los diarios y libros de este importante escritor:',
                    'Como es un país con mayoría musulmán, Marruecos representa sus hospitales con una:',
                    '¿Cómo se llaman los gorros rojos típicos que usan los marroquíes?',
                    'En Marruecos besarse y otros actos de amor en público, están prohibidos; se reservan para la intimidad del hogar:',
                );

                for($i=0;$i<5;$i++){

                    $pregunta = new \App\Pregunta();
                    $pregunta->question = $preguntas[$i];
                    $pregunta->caption = null;
                    $pregunta->trivia_id = $ii;
                    $pregunta->save();

                }
            } else if($ii == 1) {



                $imagenes = array(
                    'fake/Anise.png',
                    'fake/Artichoke.png',
                    'fake/Cardamomo.png',
                    'fake/Cinnamon.png',
                    'fake/Clavo.png',
                    'fake/Coriander.png',
                    'fake/Cumin.png',
                    'fake/Curcuma.png',
                    'fake/Cuscus.png',
                    'fake/datil.png',
                    'fake/FlorAzafran.png',
                    'fake/Ginger.png',
                    'fake/Jamaica.png',
                    'fake/Mint.png',
                    'fake/Mrouzia.png',
                    'fake/Nuts.png',
                    'fake/Olivas.png',
                    'fake/Pastela.png',
                    'fake/Pepper.png',
                    'fake/Sesame.png',
                    'reales/Blackurrant.png',
                    'reales/CamomilleHoneyVainilla.png',
                    'reales/CamomilleSpearmint.png',
                    'reales/EarlGrey.png',
                    'reales/EnglishBreakfast.png',
                    'reales/FourRedFruits.png',
                    'reales/GreenTeaCranberry.png',
                    'reales/GreenTeaEarlyGrey.png',
                    'reales/GreenTeaJasmine.png',
                    'reales/GreenTeaJasmine2.png',
                    'reales/GreenTeaLemon.png',
                    'reales/GreenTeaMint.png',
                    'reales/LadyGrey.png',
                    'reales/LemonGinger.png',
                    'reales/LemonTwist.png',
                    'reales/OrangeAndCinnamon.png',
                    'reales/PeachPassionfruit.png',
                    'reales/PureCamomille.png',
                    'reales/PureGreenTea.png',
                    'reales/PureGreenTea2.png',
                    'reales/PurePeppermint.png',
                    'reales/StrawberryMango.png',
                    'reales/SummerGarden.png',
                    'reales/VoyageIndianChai.png',
                    'reales/WildBerry.png',
                    );

                //shuffle($imagenes);
                for($i=0;$i<count($imagenes);$i++){

                    $pregunta = new \App\Pregunta();
                    $pregunta->question = $imagenes[$i];
                    $pregunta->caption = null;
                    $pregunta->trivia_id = $ii;
                    $pregunta->save();
                }
            }

        }

        $ii = 4;

        $pregunta = new \App\Pregunta();
        $pregunta->question = 'finding/FindMarruecos.png';
        $pregunta->caption = null;
        $pregunta->trivia_id = $ii;
        $pregunta->save();
    }
*/

/*
 *  JAPON
 *
 */
    public function run(){

        $trivia = 5;

        $imagenes = array(
            'fake/japon/Cantaloupe.png',
            'fake/japon/Cherry.png',
            'fake/japon/CherryBlossom.png',
            'fake/japon/Ciruela.png',
            'fake/japon/Cucumber.png',
            'fake/japon/Ginseng.png',
            'fake/japon/GinsengHoney.png',
            'fake/japon/Grapefruit.png',
            'fake/japon/HoneyGinger.png',
            'fake/japon/Kaki.png',
            'fake/japon/Katsuobushi.png',
            'fake/japon/Kiwi.png',
            'fake/japon/Orange.png',
            'fake/japon/PinnapleGinger.png',
            'fake/japon/Ramen.png',
            'fake/japon/Rise.png',
            'fake/japon/Sake.png',
            'fake/japon/Soja.png',
            'fake/japon/Wasabi.png',
            'reales/Blackurrant.png',
            'reales/CamomilleHoneyVainilla.png',
            'reales/CamomilleSpearmint.png',
            'reales/EarlGrey.png',
            'reales/EnglishBreakfast.png',
            'reales/FourRedFruits.png',
            'reales/GreenTeaCranberry.png',
            'reales/GreenTeaEarlyGrey.png',
            'reales/GreenTeaJasmine.png',
            'reales/GreenTeaJasmine2.png',
            'reales/GreenTeaLemon.png',
            'reales/GreenTeaMint.png',
            'reales/LadyGrey.png',
            'reales/LemonGinger.png',
            'reales/LemonTwist.png',
            'reales/OrangeAndCinnamon.png',
            'reales/PeachPassionfruit.png',
            'reales/PureCamomille.png',
            'reales/PureGreenTea.png',
            'reales/PureGreenTea2.png',
            'reales/PurePeppermint.png',
            'reales/StrawberryMango.png',
            'reales/SummerGarden.png',
            'reales/VoyageIndianChai.png',
            'reales/WildBerry.png',
        );

        for($i=0;$i<count($imagenes);$i++){

            $pregunta = new \App\Pregunta();
            $pregunta->question = $imagenes[$i];
            $pregunta->caption = null;
            $pregunta->trivia_id = $trivia;
            $pregunta->save();
        }


        $trivia = 6;

        $pre = 'siluetas/japon/';

        $imagenes = array(
            'Kamakura.gif',
            'PuertaDeTorii.gif',
            'MonteFuji.gif',
            'TemploHoryuji.gif',
            'TokyoSkyTree.gif'
        );
        $caption = array(
            'Esta gran estatua se encuentra en Kamakura, ¿sabes de quién hablamos?',
            'Es un arco tradicional japonés que suele encontrarse a la entrada de los santuarios sintoístas:',
            'Es el pico más alto de la isla de Honshu y de todo Japón:',
            'Este templo también es conocido como "Templo de la Enseñanza de la Ley Floreciente":',
            'Es una torre de radiodifusión, restaurante y mirador, construida en Sumida, Tokio, Japón:'
        );

        for($i=0;$i<5;$i++){

            $pregunta = new \App\Pregunta();
            $pregunta->question = $pre.$imagenes[$i];
            $pregunta->caption = $caption[$i];
            $pregunta->trivia_id = $trivia;
            $pregunta->save();
        }



        $trivia = 7;

        $preguntas = array(
                'Más de ____ ancianos centenarios viven en Japón:',
                'Es una costumbre bien vista en Japón. Se denomina "Inemuri" y se considera una muestra de lo trabajador que es el empleado y de las muchas fuerzas que le roba su labor:',
                'En Japón hay más mascotas que niños. El país tiene una de las tasas de natalidad más bajas del mundo.',
                'Está prohibido bailar en las discotecas y en los clubs después de...',
                'En Japón, los agricultores cultivan sandías de esta forma para facilitar su transporte y almacenamiento:',
            );

            for($i=0;$i<5;$i++){

                $pregunta = new \App\Pregunta();
                $pregunta->question = $preguntas[$i];
                $pregunta->caption = null;
                $pregunta->trivia_id = $trivia;
                $pregunta->save();

            }

        $trivia = 8;

        $pregunta = new \App\Pregunta();
        $pregunta->question = 'finding/FindingJapan.png';
        $pregunta->caption = null;
        $pregunta->trivia_id = $trivia;
        $pregunta->save();

    }

}



















