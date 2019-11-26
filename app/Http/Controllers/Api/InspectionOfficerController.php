<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InspectionOfficer;

class InspectionOfficerController extends Controller
{
    public function index(){
        $data = InspectionOfficer::orderBy('name', 'asc')->get();

        return response()->json($data);
    }

    public function store(Request $request){

        InspectionOfficer::firstOrCreate([
            'name' => $request->name,
            'position' => $request->position,
        ]); 

        return response()->json();
    }

    public function show($id){

    }

    public function update(Request $request, $id){
        $io = InspectionOfficer::findOrFail($id);
        $io->update([
            'name' => $request->name,
            'position' => $request->position,
        ]);

        return response()->json();
    }

    public function destroy($id){

    }
}
