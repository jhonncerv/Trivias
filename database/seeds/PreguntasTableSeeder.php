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
        $faker = Faker\Factory::create();

        for($ii = 1; $ii <= 3; $ii++){
            if($ii == 2){
                $pre = 'siluetas/';

                $imagenes = array('Desierto.gif', 'IbisEremita.gif', 'Mezquita-Hassan.gif', 'Rabat.gif', 'Tajin.gif');
                $caption = array(
                    'Éste es el templo más alto del mundo y se encuentra en Marruecos:',
                    'Es la capital del Reino de Marruecos:',
                    'Este lugar es hermoso para recorrerlo en camello:',
                    'Es una de las especies más amenazadas del mundo:',
                    'Es un utencilio clásico para los alimentos de los marroquis:'
                );

                for($i=0;$i<5;$i++){

                    $pregunta = new \App\Pregunta();
                    $pregunta->question = $pre.$imagenes[$i];
                    $pregunta->caption = $caption[$i];
                    $pregunta->trivia_id = $ii;
                    $pregunta->save();
                }

            } else {

                for($i = 0; $i < 20; $i++){
                    $pregunta = new \App\Pregunta();
                    $pregunta->question = $ii > 2 ? $faker->sentence : $faker->imageUrl;
                    $pregunta->caption = null;
                    $pregunta->trivia_id = $ii;
                    $pregunta->save();
                }

            }

        }
    }
}
