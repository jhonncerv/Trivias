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


        $pre = '/postal/';
        $ciudad = array('Marruecos', 'Argentina', 'India', 'Inglaterra', 'Japon');
        for ($i = 1; $i <= 5; $i++ ){
            for ($j = 1; $j <= 5; $j++ ){
                $postal = new \App\Postal();
                $postal->name = $ciudad[$i-1].'0'.$j;
                $postal->url = $pre.$ciudad[$i-1].'0'.$j.'.png';
                $postal->points = 20;
                $postal->ciudad_id = $i;
                $postal->save();
            }
        }
    }
}
