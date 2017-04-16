<?php

use Illuminate\Database\Seeder;

class PreguntasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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



/*
 *  JAPON
 *
 */

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


/*
 * 
 *  India
 *
 */

        $trivia = 9;


        $imagenes = array(
            'fake/india/Banana.png',
            'fake/india/Bergamota.png',
            'fake/india/Cardamomo.png',
            'fake/india/Chickpea.png',
            'fake/india/CilantroMenta.png',
            'fake/india/Clove.png',
            'fake/india/Coconut.png',
            'fake/india/Coffee.png',
            'fake/india/CorianderMint.png',
            'fake/india/Ghee.png',
            'fake/india/Lassi.png',
            'fake/india/Laurel.png',
            'fake/india/Lychee.png',
            'fake/india/Mango.png',
            'fake/india/Papaya.png',
            'fake/india/Saffron.png',
            'fake/india/Sunflower.png',
            'fake/india/WhiteTea.png',
            'fake/india/Yoghurt.png',
            'fake/india/Zapota.png',
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

        $trivia = 10;

        $pre = 'siluetas/india/';

        $imagenes = array(
            'TajMahal.gif',
            'Loto.gif',
            'PuertaIndia.gif',
            'Elefante.gif',
            'Mandala.gif',
        );

        $caption = array(
            'Es el símbolo más representativo de la India:',
            'En este templo cualquier religión está invitada:',
            'Ubicada en el llamado "camino de los reyes" Rajpath en la ciudad india de Nueva Delhi:',
            'Estos animales son asociados a la religión hindú y la herencia cultural. Una India sin ellos es simplemente inimaginable.',
            'Diagrama simbólico que en el budismo representa la evolución del universo respecto a un punto central:',
        );

        for($i=0;$i<5;$i++){

            $pregunta = new \App\Pregunta();
            $pregunta->question = $pre.$imagenes[$i];
            $pregunta->caption = $caption[$i];
            $pregunta->trivia_id = $trivia;
            $pregunta->save();
        }

        $trivia = 11;

        $preguntas = array(
            'La India es el segundo país más poblado del mundo, con más de:',
            'Monjes nómadas que siempre viajan en busca de la iluminación. Tienen bastantes libertades, entre ellas fumar marihuana o viajar gratis en el tren: ',
            'Es un animal sagrado en la India, así que está prohibido sacrificarlo. Viven libremente por todo el país, incluso por las ciudades, y es frecuente encontrarles en todos los sitios, incluso en las estaciones de tren:',
            'El ajedrez, el algebra y la trigonometría tienen su origen en la India:',
            'Es un río considerado sagrado, y si vas a la ciudad de Varanasi verás como los hindúes queman a sus fallecidos en las orillas del río:',
        );

        for($i=0;$i<5;$i++){

            $pregunta = new \App\Pregunta();
            $pregunta->question = $preguntas[$i];
            $pregunta->caption = null;
            $pregunta->trivia_id = $trivia;
            $pregunta->save();

        }

        $trivia = 12;

        $pregunta = new \App\Pregunta();
        $pregunta->question = 'finding/FindingIndia.png';
        $pregunta->caption = null;
        $pregunta->trivia_id = $trivia;
        $pregunta->save();


    /*
     *  Argentina
     *
     */


        $trivia = 13;

        $imagenes = array(
            'fake/argentina/Alfajor.png',
            'fake/argentina/Algarrobo.png',
            'fake/argentina/Anana.png',
            'fake/argentina/Apple.png',
            'fake/argentina/Barley.png',
            'fake/argentina/Basil.png',
            'fake/argentina/Cebada.png',
            'fake/argentina/Centeno.png',
            'fake/argentina/Chimichurri.png',
            'fake/argentina/Cranberry.png',
            'fake/argentina/Darjeeling.png',
            'fake/argentina/DulceDeLeche.png',
            'fake/argentina/Fig.png',
            'fake/argentina/Mate.png',
            'fake/argentina/Palmito.png',
            'fake/argentina/Peach.png',
            'fake/argentina/Pesto.png',
            'fake/argentina/Pineapple.png',
            'fake/argentina/Polenta.png',
            'fake/argentina/Sugarcane.png',
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

        $trivia = 14;

        $pre = 'siluetas/argentina/';

        $imagenes = array(
            'Obelisco.gif',
            'FaroSanJuan.gif',
            'Tango.gif',
            'MuseoNacional.gif',
            'CatedralPlata.gif',
        );

        $caption = array(
            'El ícono más grande de Argentina:',
            'La novela de Julio Verne, "El faro del fin del mundo", le dio fama y su apodo:',
            'Es un género musical y una danza características de la región del Río de la Plata y su zona de influencia:',
            '¿Puedes adivinar cómo se llama este lugar?',
            'Principal templo católico de la ciudad de La Plata, capital de la Provincia de Buenos Aires:',
        );

        for($i=0;$i<5;$i++){

            $pregunta = new \App\Pregunta();
            $pregunta->question = $pre.$imagenes[$i];
            $pregunta->caption = $caption[$i];
            $pregunta->trivia_id = $trivia;
            $pregunta->save();
        }

        $trivia = 15;

        $preguntas = array(
            'Argentina ha sido distinguida con cinco Premios Nobel: dos de la Paz, dos de Medicina y uno de: ',
            '¿Cuál de éstos en un postre típico de Argentina? ',
            'Es el río más ancho del mundo, en el que confluyen el río Paraná y el río Uruguay: ',
            'El goleador más grande de todos los tiempos en Argentina ha sido: ',
            'Patrimonio de la Humanidad y uno de los lugares más visitados en Argentina:',
        );

        for($i=0;$i<5;$i++){

            $pregunta = new \App\Pregunta();
            $pregunta->question = $preguntas[$i];
            $pregunta->caption = null;
            $pregunta->trivia_id = $trivia;
            $pregunta->save();

        }

        $trivia = 16;

        $pregunta = new \App\Pregunta();
        $pregunta->question = 'finding/FindingArgentina.png';
        $pregunta->caption = null;
        $pregunta->trivia_id = $trivia;
        $pregunta->save();
    /*
     *  Inglaterra
     *
     */


        $trivia = 17;

        $imagenes = array(
            'fake/londres/AlmondCinnamon.png',
            'fake/londres/AssamTea.png',
            'fake/londres/Blackberry.png',
            'fake/londres/BlackTea.png',
            'fake/londres/Blueberry.png',
            'fake/londres/Caramel.png',
            'fake/londres/Citrics.png',
            'fake/londres/EarlGreyRoyal.png',
            'fake/londres/EnglishAfternoon.png',
            'fake/londres/EnglishNights.png',
            'fake/londres/GreenMint.png',
            'fake/londres/Hibiscus.png',
            'fake/londres/Juniper.png',
            'fake/londres/Lavender.png',
            'fake/londres/OrangeCocoa.png',
            'fake/londres/OrangePinnaple.png',
            'fake/londres/Raspberry.png',
            'fake/londres/RedTea.png',
            'fake/londres/Strawberry.png',
            'fake/londres/Vanilla.png',
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

        $trivia = 18;

        $pre = 'siluetas/londres/';

        $imagenes = array(
            'Beatles.gif',
            'BigBen.gif',
            'Cabina.gif',
            'Puente.gif',
            'Camion.gif',
        );

        $caption = array(
            'Es la máxima representación de la música en Londres y el mundo: ',
            'Mide 96 metros de altura y es la tercera torre del reloj más alta del mundo: ',
            'Si viajas a Londres no te puede faltar la típica foto con esto:',
            'Ubicado sobre el rio Támesis: ',
            'Se crearon para poder transportar un mayor número de pasajeros para no tener que exceder los límites legales sobre la longitud de los vehículos:',
        );

        for($i=0;$i<5;$i++){

            $pregunta = new \App\Pregunta();
            $pregunta->question = $pre.$imagenes[$i];
            $pregunta->caption = $caption[$i];
            $pregunta->trivia_id = $trivia;
            $pregunta->save();
        }

        $trivia = 19;

        $preguntas = array(
            'Todas las casas y pisos del centro de Londres son propiedad de la Corona Británica. Aunque se compren, éstos tienen una duración de 10 años, luego vuelven a pasar a manos de: ',
            'El metro de Londres es el más antiguo del mundo, comenzó a funcionar en: ',
            'Aunque algunos lo buscan en Liverpool, el paso de cebra que popularizaron los Beatles en Abbey Road está en el barrio de: ',
            'En el súper, cuando la comida va a caducar, al final del día ponen los productos a mitad de precio.',
            'Londres nunca ha sido reconocido por su gastronomía, sin embargo, encuentras platillos deliciosos. Las especialidades son el fish and chips, jacket potatoe y:',
        );

        for($i=0;$i<5;$i++){

            $pregunta = new \App\Pregunta();
            $pregunta->question = $preguntas[$i];
            $pregunta->caption = null;
            $pregunta->trivia_id = $trivia;
            $pregunta->save();

        }
        $trivia = 20;

        $pregunta = new \App\Pregunta();
        $pregunta->question = 'finding/FindingInglaterra.png';
        $pregunta->caption = null;
        $pregunta->trivia_id = $trivia;
        $pregunta->save();
    }

}



















