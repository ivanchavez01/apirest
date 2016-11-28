<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $owner = new \App\Role();
        $owner->name = "owner";
        $owner->display_name = "Product Owner";
        $owner->description = "Product owner of a given project";
        $owner->save();

        $owner = new \App\Role();
        $owner->name = "admin";
        $owner->display_name = "admin user";
        $owner->description = "Product owner of a given project";
        $owner->save();
    }
}
