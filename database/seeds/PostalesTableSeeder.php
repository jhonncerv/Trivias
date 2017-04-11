<?php

use Illuminate\Database\Seeder;

class PostalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $var = array(
            'postales/Marruecos01.png',
            'postales/Marruecos02.png',
            'postales/Marruecos03.png',
            'postales/Marruecos04.png',
            'postales/Marruecos05.png',
            'postales/Argentina01.png',
            'postales/Argentina02.png',
            'postales/Argentina03.png',
            'postales/Argentina04.png',
            'postales/Argentina05.png',
            'postales/India01.png',
            'postales/India02.png',
            'postales/India03.png',
            'postales/India04.png',
            'postales/India05.png',
            'postales/Inglaterra01.png',
            'postales/Inglaterra02.png',
            'postales/Inglaterra03.png',
            'postales/Inglaterra04.png',
            'postales/Inglaterra05.png',
            'postales/Japon01.png',
            'postales/Japon02.png',
            'postales/Japon03.png',
            'postales/Japon04.png',
            'postales/Japon05.png',
        );

        for($i = 1; $i < count($var); $i++){
            $postal = new \App\Postal();
            $postal->name = 'Postal';
            $postal->url = $var[$i];
            $postal->points = 10;
            $postal->ciudad_id = ($i > 5) ? ($i > 10 ? ($i > 15 ? ($i > 20 ? 5 : 4) : 3) : 2) : 1;
        }
    }
}
