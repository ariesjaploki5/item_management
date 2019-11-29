<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Batch;
use DB;

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
}
