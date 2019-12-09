<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\User as UserResource;

class UserController extends Controller
{
    public function index(){
        $users = UserResource::collection(User::where('id', '<>',1)->get());

        return response()->json($users);
    }

    public function store(Request $request){
        
        User::create([
            'employee_id' => $request->employee_id,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        return response()->json();
    }

    public function search_user($search_word){
        $users = User::whereHas('employee', function($query) use ($search_word){
            $query->where('employee_name', 'like', '%'.$search_word.'%');
        })->get();

        return response()->json($users);
    }

    public function update(Request $request, $id){


    }

    public function show($id){


    }

    public function destroy($id){

    }
}
