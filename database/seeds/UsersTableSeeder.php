<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = new \App\User();
        $user->email = 'jhonncerv@gmail.com';
        $user->password = bcrypt('qwe123');
        $user->rol = 1;
        $user->save();

        $user = new \App\User();
        $user->email = 'admin@gmail.com';
        $user->password = bcrypt('qwe123');
        $user->rol = 1;
        $user->save();


    }
}
