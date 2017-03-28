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
        $user->name = 'Jhonn';
        $user->email = 'jhonncerv@gmail.com';
        $user->password = bcrypt('qwe123');
        $user->save();
    }
}
