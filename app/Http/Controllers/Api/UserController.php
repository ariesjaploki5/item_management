<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index(){
        $users = User::all();

        return $users;
    }

    public function store(Request $request){

    }

    public function update(Request $request, $id){


    }

    public function show($id){


    }

    public function destroy($id){

    }
}
