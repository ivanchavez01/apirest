<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public $table = "brands";
    public $fillable = [
        "brand_name"
    ];
}
