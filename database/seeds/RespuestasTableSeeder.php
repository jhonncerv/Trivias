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

        $faker = Faker\Factory::create();

        for ($d = 0; $d < 5; $d++){
            for ($e = 1; $e <= 50; $e++) {
                for ($i = 0; $i < 2; $i++) {
                    $respuesta = new \App\Respuesta();
                    $respuesta->option = $d > 1 ? $faker->word : !$i ? 'izquierda': 'derecha';
                    $respuesta->correct = !$i;
                    $respuesta->pregunta_id = ($d * 50) + $e;
                    $respuesta->save();
                }
            }
        }
    }
}
