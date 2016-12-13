<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    public $table = "stock";
    public $primaryKey = "stock_id";

    public $fillable = [
        "supplier_id",
        "stock_name",
        "quantity"
    ];
}
