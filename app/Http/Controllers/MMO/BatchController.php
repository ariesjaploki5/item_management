<?php

namespace App\Http\Controllers\MMO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\MMO\Batch as BatchResource;
use App\MMO\Batch;
use DB;

class BatchController extends Controller
{

    public function index(){

    }

    public function store(Request $request){

    }

    public function show($id){

    }

    public function show_using_item_id($id){

        $select_batches = DB::table("mmo.dbo.tfn_batches()")->where('item_id', $id)->orderBy('expiration_date', 'asc')->get();
        
        $batches = BatchResource::collection($select_batches);
        
        return response()->json($batches);
    }

    public function update(Request $request, $id){

    }

    

    public function destroy($id){

        
    }
}
