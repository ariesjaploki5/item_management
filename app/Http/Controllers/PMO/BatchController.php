<?php

namespace App\Http\Controllers\PMO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\PMO\Batch;
use App\Http\Resources\MMO\Batch as BatchResource;

class BatchController extends Controller
{
    public function index(){
        $data = DB::table("mmo.dbo.tfn_batches()")->where('remaining_quantity', '>', 0)->get();

        return response()->json($data);
    }

    public function store(Request $request){

        $batch = Batch::create([
            'batch_no' => $request->batch_no,
            'iar_no' => $request->iar_no,
            'item_id' => $request->item_id,
            'brand_id' => $request->brand_id,
            'cost' => $request->cost,
            'quantity' => $request->quantity,
            'expiration_date' => $request->expiration_date,
            'remarks' => $request->remarks,
            'fund_cluster_id' => $request->fund_cluster_id,
            
        ]);
        
        return response()->json($batch);
    }

    public function search_batch($search_word){
        $select_batches = DB::table("mmo.dbo.tfn_pmo_batches()")->where('item_desc', 'like', '%'.$search_word.'%')->orderBy('expiration_date', 'asc')->get();
        
        $batches = BatchResource::collection($select_batches);
        
        return response()->json($batches);
    }
}
