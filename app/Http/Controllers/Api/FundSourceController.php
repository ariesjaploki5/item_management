<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FundSource;

class FundSourceController extends Controller
{
    public function index(){
        $data = FundSource::all();

        return response()->json($data);
    }
}
