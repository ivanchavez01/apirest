<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public $table = "groups_suppliers";
    public $fillable = [
        "group_name"
    ];
}
