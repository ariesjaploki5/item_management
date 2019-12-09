<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Manufacturer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;

class ManufacturerController extends Controller
{
    public function index(){
        $manufacturers = Manufacturer::orderBy('manufacturer_desc', 'asc')->get();

        return response()->json($manufacturers);
    }

    public function store(Request $request){
        

    }

    public function show($id){


    }

    public function update(Request $request, $id){


    }

    public function destroy($id){

        
    }
}
