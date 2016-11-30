<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    public $table = "products_stock";
    public $fillable = [
        "product_id",
        "stock_id",
        "quantity"
    ];
}
