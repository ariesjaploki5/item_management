<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ApprovingOfficer;

class ApprovingOfficerController extends Controller
{
    public function index(){
        $data = ApprovingOfficer::orderBy('name', 'asc')->get();

        return response()->json($data);
    }

    public function store(Request $request){
        $ao = ApprovingOfficer::create([
            'name' => $request->name,
        ]);

        return response()->json();
    }

    public function update(Request $request, $id){

    }

    public function destroy($id){

    }
}
