<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsSku extends Model
{
    public $table = "products_sku";
    public $fillable = [
        "product_id",
        "supplier_id",
        "sku",
        "quantity",
        "price"
    ];
}
