<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);
//        $this->call(PostalesTableSeeder::class);
        //$this->call(CiudadesTableSeeder::class);
//        $this->call(TriviasTableSeeder::class);
//        $this->call(PreguntasTableSeeder::class);
        $this->call(RespuestasTableSeeder::class);
    }
}
