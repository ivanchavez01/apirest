<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $table = "products";
    public $fillable = [
        "brand_id",
        "group_id",
        "model",
        "name",
        "description",
        "price",
        "quantity",
        "image",
        "warranty",
        "discount",
        "promotionDescription",
        "currencyRate",
        "promotionDateEnd"
    ];
}
