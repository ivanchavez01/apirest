<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Group;

class GroupController extends Controller
{
    public function index() {
        return Group::all();
    }
}
