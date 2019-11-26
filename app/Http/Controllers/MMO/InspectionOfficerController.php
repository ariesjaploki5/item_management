<?php

namespace App\Http\Controllers\MMO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MMO\InspectionOfficer;

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
        
        $io = InspectionOfficer::findOrFail($id);
        
        return response()->json($io);
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
        $io = InspectionOfficer::where('inspection_officer_id', $id)->first();
        $io->delete();

        return response()->json();
    }
}
