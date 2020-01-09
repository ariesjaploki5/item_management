<?php

namespace App\Http\Controllers\PMO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PMO\Ris;
use App\PMO\BatchRis;
use App\PMO\Batch;
use App\Http\Resources\MMO\Ris as RisResource;
use Carbon\Carbon;
use DB;
use App\Models\Item;
use App\PMO\Hdmhdrbrand;
use App\Views\PmoRis as ViewPmoRis;

class RisController extends Controller
{
    public function index(){

        $data = RisResource::collection(ViewPmoRis::all());

        return response()->json($data);

    }

    public function control_no(){

        $now = Carbon::now();
        $year_now = $now->year;
        $month_now = $now->month;
        $month = sprintf('%02d', $month_now);
        $year_month = $year_now.'-'.$month;
        $count = Ris::whereYear('created_at', $year_now)->count();

        if ($count > 0) {

            $last_ris = Ris::orderBy('control_no', 'desc')->first();
            $last_control_no = substr($last_ris->control_no, -4);
            $new = (int)$last_control_no + 1;
            $new_control_no = sprintf('%04d', $new);
            $control_no = $year_month.'-'.$new_control_no;

        } else {
            $control_no = $year_month.'-'.'0001';
        }

        return $control_no;
    }

    public function store(Request $request){

        $control_no = $this->control_no();
        $batch = $request->batches;

        Ris::create([
            'control_no' => $control_no,
            'ris_date' => Carbon::today(),
            'requested_by' => $request->user_id,
            // 'requested_by' => auth('api')->user(),
            'requested_date' => Carbon::today(),
            'purpose' => $request->purpose,
        ]);

        $this->store_batch_ris($control_no, $batch);
    }

    public function store_batch_ris($control_no, $batch){


        $count = count($batch);

        for($i = 0; $i < $count; $i++){


            $batch_no = $batch[$i]['batch_no'];
            $requested_quantity = $batch[$i]['requested_quantity'];
            $remaining_quantity = $batch[$i]['remaining_quantity'];

            if($requested_quantity <= $remaining_quantity){

                BatchRis::create([
                    'batch_no' => $batch_no,
                    'control_no' => $control_no,
                    'requested_quantity' => $requested_quantity,
                ]);

            } else {

                BatchRis::create([
                    'batch_no' => $batch_no,
                    'control_no' => $control_no,
                    'requested_quantity' => $remaining_quantity,
                ]);
            }
            
        }

        return response()->json();
    }

    public function update(Request $request, $control_no){
        $ris = Ris::findOrFail($control_no);
        $batch = $request->batches;

        $ris->update([
            'purpose' => $request->purpose,
        ]);


        $this->update_batch_ris($control_no, $batch);
    }

    public function update_batch_ris($control_no, $batch){
        // BatchRis::where('control_no', $control_no)->delete();

        $count = count($batch);

        for($i = 0; $i< $count; $i++){
            $batch_no = $batch[$i]['batch_no'];
            $requested_quantity = $batch[$i]['requested_quantity'];
            $issued_quantity = $batch[$i]['issued_quantity'];

            BatchRis::updateOrCreate([
                'batch_no' => $batch_no,
                'control_no' => $control_no,
                'requested_quantity' => $requested_quantity,
            ], [
                'issued_quantity' => $issued_quantity,
            ]);
        }

        return response()->json();
    }

    public function issued(Request $request, $control_no){

        $batch = $request->batches;
        $ris = Ris::findOrFail($control_no);

        $ris->update([
            'issued_by' => auth('api')->user()->id,
            'issued_date' => Carbon::today(),
        ]);

        $this->issue_batch_ris($control_no, $batch);   
    }

    public function issue_batch_ris($control_no, $batch){

        $count = count($batch);

        for($i = 0; $i < $count; $i++){

            $batch_no = $batch[$i]['batch_no'];
            $issued_quantity = $batch[$i]['issued_quantity'];
            $requested_quantity = $batch[$i]['requested_quantity'];
            
            if($issued_quantity <= $requested_quantity){
                BatchRis::updateOrCreate([
                    'control_no' => $control_no,
                    'batch_no' => $batch_no,
                ],[
                    'issued_quantity' => $issued_quantity,
                ]);
            } else {
                BatchRis::updateOrCreate([
                    'control_no' => $control_no,
                    'batch_no' => $batch_no,
                ],[
                    'issued_quantity' => $requested_quantity,
                ]);
            }
            

        }

        return response()->json();
    }

    public function approved(Request $request, $id){
        $ris = Ris::findOrFail($id);
        $ris->update([
            'approved_by' => $request->user_id,
            'approved_date' => Carbon::today(),
        ]);

        return response()->json();
    }

    public function received(Request $request, $id){
        $ris = Ris::findOrFail($id);
        $ris->update([
            'received_by' => $request->user_id,
            'received_date' => Carbon::today(),
        ]);
        $batch = $request->batches;
        
        $this->receive_batches($batch);

        return response()->json();
    }

    public function receive_batches($batch){

        $count = count($batch);

        // for drugs and medicine
        for($i = 0; $i < $count; $i++){

            $batch_no = $batch[$i]['batch_no'];
            $issued_quantity = $batch[$i]['issued_quantity'];
            $requested_quantity = $batch[$i]['requested_quantity'];
            
            $batch_ris_id = $batch[$i]['batch_ris_id'];

            $br = DB::table("mmo.dbo.tfn_pmo_batches_to_transfer()")->where('batch_ris_id', $batch_ris_id)->first();

            $dmhdrsub = 'DRUMB';

            $transfer = Hdmhdrbrand::where('dmdcomb', $br->dmdcomb)
            ->where('dmdctr', $br->dmdctr)
            ->where('dmhdrsub', $dmhdrsub)
            ->where('brand', $br->brand)
            ->where('unit_price', $br->cost)
            ->where('selling_price', $br->cost/0.75)
            ->where('exp_date', $br->expiration_date)
            ->first();

            if($transfer === null){
                DB::table("mmo.dbo.pmo_hdmhdrbrands")->insert([
                    'dmdcomb' => $br->dmdcomb, 
                    'dmdctr' => $br->dmdctr, 
                    'dmhdrsub' => 'DRUMB', 
                    'brand' => $br->brand,
                    'unit_price' => $br->cost,
                    'selling_price' => $br->cost/0.75,
                    'stockbal' => $br->issued_quantity,
                    'exp_date' => $br->expiration_date,
                    'created_at' => Carbon::now(),
                    'statusMed' => 'I',
                ]);
            } else {
                Hdmhdrbrand::where('dmdcomb', $br->dmdcomb)
                ->where('dmdctr', $br->dmdctr)
                ->where('dmhdrsub', $dmhdrsub)
                ->where('brand', $br->brand)
                ->where('unit_price', $br->cost)
                ->where('exp_date', $br->expiration_date)
                ->where('selling_price', $br->cost/0.75)->update([
                    'stockbal' => $transfer->stockbal + $br->issued_quantity,
                    'updated_at' => Carbon::now()
                ]);
            }
        }

        return true;
    }

    public function show($id){

        $data = new RisResource(ViewPmoRis::find($id));

        return response()->json($data);
    }

    public function show_2($id){
        $select_table = DB::table('mmo.dbo.tfn_ris()')->where('ris_no', $id)->get();


        return response()->json($select_table);
    }

    public function destroy($id){


    }

    public function report(Request $request){
        $date_from = $request->date_from;
        $date_to = $request->date_to;

        $report = DB::table("mmo.dbo.tfn_report_ris($date_from, $date_to)")->get();

        return response()->json($report);
    }
}
