<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EndUserStock;
use App\Logs\Stock as StockLogs;

use DB;

class StockController extends Controller
{
    public function index(){
        
    }

    public function store(Request $request){
        $eus = EndUserStock::create([
            'sl_code' => $request->sl_code,
            'cost' => $request->cost,
            'quantity' => $request->quantity,
            'expiration_date' => $request->expiration_date,
            'remarks' => $request->remarks,
            'batch_no' => $request->batch_no,
            'end_user_id' => $request->end_user_id,
            'iar_no' => $request->iar_no,
        ]);

        return response()->json($eus);
    }

    public function update(Request $request, $id){
        
        $eus = EndUserStock::firstOrCreate([
            'sl_code' => $id,
        ]);
        
        if($request->type_id = 1){
            EndUserStock::where('sl_code', $id)->increment('quantity', $request->quantity);
        } else {
            EndUserStock::where('sl_code', $id)->decrement('quantity', $request->quantity);
        }

        $sl = StockLogs::create([
            'sl_code' => $id,
            'user_id' => auth('api')->user()->id,
            'type_id' => $request->type_id,
            'quantity' => $request->quantity,
        ]);

        return response()->json($eus);
    }

    public function update_beginning_balance(Request $request, $id){
        $eus = EndUserStock::where('sl_code', $id)->where('end_user_id', 1)->first();

        $eus->update([
            'quantity' => $request->stock,
        ]);

        return response()->json();
    }

    public function destroy($id){

    }
}
