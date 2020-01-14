<?php

namespace App\Http\Controllers\Homis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class HchargeController extends Controller
{
    public function index(){
        $data = DB::table('hospital.dbo.hcharge')->orderBy('chrgdesc')->get();

        return response()->json($data);
    }
}
