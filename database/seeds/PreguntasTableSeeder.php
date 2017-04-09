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
            for($i = 0; $i < 50; $i++){
                $pregunta = new \App\Pregunta();
                $pregunta->question = $ii > 2 ? $faker->sentence : $faker->imageUrl;
                $pregunta->trivia_id = $ii;
                $pregunta->save();
            }
        }
    }
}
