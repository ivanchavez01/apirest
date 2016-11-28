<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        $createProduct = new \App\Permission();
        $createProduct->name = "create-product";
        $createProduct->display_name = "Create Products";
        $createProduct->description = "create new product";
        $createProduct->save();
    }
}
