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
        

    }

    public function show($id){


    }

    public function update(Request $request, $id){


    }

    public function destroy($id){

        
    }
}
