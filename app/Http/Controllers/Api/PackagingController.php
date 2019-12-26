<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Packaging;
use Carbon\Carbon;

use Illuminate\Support\Facades\Response;

class PackagingController extends Controller
{
    public function index(){
        $data = Packaging::orderBy('packaging_desc', 'asc')->get();

        return response()->json($data);
    }

    public function store(Request $request){
        $packaging = Packaging::create([
            'packaging_desc' => $request->packaging_desc,
        ]);

        return response()->json();
    }

    public function show($id){
        $packaging = Packaging::find($id);
        
        return response()->json($packaging);
    }

    public function update(Request $request, $id){
        $packaging = Packaging::find($id);
        $packaging->update([
            'packaging_desc' => $request->packaging_desc,
        ]);
        
        return response()->json();
    }

    public function destroy($id){
        $packaging = Packaging::where('packaging_id', $id)->first();
        $packaging->delete();
        
        return response()->json();
    }
}
