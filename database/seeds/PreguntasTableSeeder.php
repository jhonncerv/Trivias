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
                    'Oficialmente cómo es conocido Marruecos:',
                    'El ritual del té están descritos en los diarios y libros de este importante escritor: ',
                    'Como es un país musulman, Marruecos representa sus hospitales con una:',
                    '¿Cómo se llaman los gorros típicos rojos que usan los marroquis? ',
                    'En Marruecos besarse y otros tipos de actos de amor están prohibidos al publico, se receban para la intimidad del hogar:',
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
}
