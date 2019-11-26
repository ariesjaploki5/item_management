<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Iar;
use App\Http\Resources\Iar as IarResource;
use App\Models\Batch;
use Carbon\Carbon;
use App\Models\Brand;

class IarController extends Controller
{
    
    public function index(){
        $data = IarResource::collection(Iar::all());
        
        return response()->json($data);
    }

    public function new_iar(){

        $now = Carbon::now();
        $year_now = $now->year;
        $month_now = $now->month;
        $month = sprintf('%02d', $month_now);
        $year_month = $year_now.'-'.$month;
        $count = Iar::whereYear('created_at', $year_now)->count();

        if ($count > 0) {

            $last_iar = Iar::orderBy('iar_no', 'desc')->first();
            $last_iar_no = substr($last_iar->iar_no, -4);
            $new = (int)$last_iar_no + 1;
            $new_iar_no = sprintf('%04d', $new);
            $iar_no = $year_month.'-'.$new_iar_no;

        } else {
            $iar_no = $year_month.'-'.'0001';
        }

        return $iar_no;
    }

    public function store(Request $request){

        $po_no = $request->po_no;
        $inspection_officer_id = $request->inspection_officer_id;
        $inspection_date = $request->inspection_date;
        $receiving_officer_id = $request->receiving_officer_id;
        $received_date = $request->received_date;
        $ref_no = $request->ref_no;
        $ref_date = $request->ref_date;
        $batch = $request->batches;
        $iar_no = $this->new_iar();

        Iar::firstOrCreate([
            'po_no' => $po_no,
            'inspection_officer_id' => $inspection_officer_id,
            'inspection_date' => $inspection_date,
            'receiving_officer_id' => $receiving_officer_id,
            'received_date' => $received_date,
            'ref_no' => $ref_no,
            'ref_date' => $ref_date,
        ],[
            'iar_no' => $iar_no,
        ]);

        $this->batches($iar_no, $batch);

        return response()->json($iar_no);
    }

    public function batches($iar_no, $batch){

        $count_2 = count($batch);

        for($i = 0;$i < $count_2;$i++){
            
            $cost = $batch[$i]['cost'];
            $item_id = $batch[$i]['item_id'];
            $quantity = $batch[$i]['received_quantity'];
            $batch_no = $batch[$i]['batch_no'];
            $expiration_date = $batch[$i]['expiration_date'];
            $remarks = $batch[$i]['remarks'];
            
            $brand_id = $batch[$i]['brand_id'];
            
            // $brand = Brand::firstOrCreate([
            //     'brand_desc' => $batch[$i]['brand_desc'],
            // ]);

            // $brand_id = $brand->brand_id;  

            Batch::create([
                'iar_no' => $iar_no,
                'cost' => $cost,
                'brand_id' => $brand_id,
                'item_id'=> $item_id,
                'quantity' => $quantity,
                'batch_no' => $batch_no,
                'expiration_date' => $expiration_date,
                'remarks' => $remarks, 
            ]);
        }

        return true;
    }

    public function show($id){

        $iar = new IarResource(Iar::findOrfail($id));

        return response()->json($iar);
    }


    public function update(Request $request, $id){
        $iar = Iar::findOrFail($id);
        $iar->update([
            'po_id' => $request->po_id,
        ]);

        return response()->json();
    }

    public function destroy($id){
        $iar = Iar::where('iar_no', $id)->first();
        $iar->batches()->delete();
        $iar->delete();

        return response()->json();
    }
}
