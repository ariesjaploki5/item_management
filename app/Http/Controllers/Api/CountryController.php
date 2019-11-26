<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;

class CountryController extends Controller
{
    public function index(){
        $countries = Country::orderBy('country_desc', 'asc')->get();

        return response()->json($countries);
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
