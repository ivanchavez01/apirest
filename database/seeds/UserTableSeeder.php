<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        $user = new \App\User();
        $user->name = "Ivan Chavez";
        $user->email = "iecs_1990@hotmail.com";
        $user->password = Hash::make("123456");
        $user->save();
    }
}
