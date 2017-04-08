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

        for($ii = 1; $ii <= 5; $ii++){
            for($i = 0; $i < 50; $i++){
                $pregunta = new \App\Pregunta();
                $pregunta->question = $faker->sentence;
                $pregunta->trivia_id = $ii;
                $pregunta->save();
            }
        }
    }
}
