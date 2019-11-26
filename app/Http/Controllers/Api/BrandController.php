<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;

class BrandController extends Controller
{
    public function index(){
        $brands = Brand::orderBy('brand_desc', 'asc')->get();

        return $brands;
    }

    public function store(Request $request){
        Brand::firstOrCreate([
            'brand' => $request->brand,
        ]);

        return response()->json();
    }

    public function show($id){


    }

    public function update(Request $request, $id){


    }

    public function destroy($id){

        
    }
}
