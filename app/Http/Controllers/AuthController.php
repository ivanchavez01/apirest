<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function index() {
        return JWTAuth::parseToken()->toUser();
    }

    public function show() {
        //return User::all();
        return JWTAuth::parseToken()->toUser();
    }

    public function attachRole($userId, $role) {
        $user = User::find($userId);
        $roleId = Role::where(["name" => $role])->first();

        $user->roles()->attach($roleId);
        return $user;
    }

    public function getRole($userId) {
        return User::find($userId)->roles;
    }

    public function attachPermission(Request $req) {
        $params = $req->only('permission', 'role');

        $role = Role::where('name', $params['role'])->first();
        $permission = Permission::find($params['permission'])->first();

        $role->attachPermission($permission);

        return $this->response->created();
    }

    public function getPermission($role){
        $role = Role::where('name', $role)->first();

        return $this->response->array($role->perms);
    }
}
