<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class BatchController extends Controller
{
    public function index(){
        $data = DB::table("mmo.dbo.tfn_batches()")->where('remaining_quantity', '>', 0)->get();

        return response()->json($data);
    }

}
