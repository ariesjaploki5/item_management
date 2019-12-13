<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ris;
use App\Models\BatchRis;
use App\Models\ItemRis;
use App\Http\Resources\Ris as RisResource;
use Carbon\Carbon;

class RisController extends Controller
{

    public function index(){

        $riss = Ris::orderBy('control_no', 'desc')->get();

        $data = RisResource::collection($riss);

        return response()->json($data);

    }

    public function riss_by_category($category_id){
        $riss = Ris::where('category_id', $category_id)->orderBy('control_no', 'desc')->get();

        $data = RisResource::collection($riss);

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

    public function update_ofs_ris(Request $request, $control_no){


        $item = $request->items;

        $ris = Ris::find($control_no);

        $ris->update([
            'ris_no' => $request->ris_no,
        ]);

        $this->update_ofs_items($control_no, $item);

        return response()->json($control_no);
    }
    
    public function update_ofs_items($control_no, $item){
        $count = count($item);

        for($i = 0; $i < $count; $i++){

            $item_id = $item[$i]['item_id'];
            $requested_quantity = $item[$i]['requested_quantity'];
            $issued_quantity = $item[$i]['issued_quantity'];

            $item_ris = ItemRis::where('item_id', $item_id)->where('control_no', $control_no)->where('requested_quantity', $requested_quantity)->first();
            $item_ris->update([
                'issued_quantity' => $issued_quantity,
            ]);
        }

        return true;
    }

    public function store_ofs_ris(Request $request){
        $control_no = $this->control_no();
        $item = $request->items;

        Ris::create([
            'control_no' => $control_no,
            'ris_date' => Carbon::today(),
            'requested_by' => auth('api')->user()->id,
            'requested_date' => Carbon::today(),
            'purpose' => $request->purpose,
            'category_id' => 5
        ]);

        $this->store_ofs_items($control_no, $item);

        return response()->json($control_no);
    }

    public function store_ofs_items($control_no, $item){
        $count = count($item);

        for($i = 0; $i < $count; $i++){

            $item_id = $item[$i]['item_id'];
            $requested_quantity = $item[$i]['requested_quantity'];
 
            ItemRis::create([
                'item_id' => $item_id,
                'control_no' => $control_no,
                'requested_quantity' => $requested_quantity,
            ]);
        }

        return true;
    }

    public function issue_ofs_ris(Request $request, $control_no){

        $item = $request->items;
        $ris = Ris::findOrFail($control_no);

        $ris->update([
            'issued_by' => auth('api')->user()->id,
            'issued_date' => Carbon::today(),
        ]);

        $this->issue_item_ris($control_no, $item); 
    }

    public function issue_item_ris($control_no, $item){

        $count = count($item);

        for($i = 0; $i < $count; $i++){

            $item_id = $item[$i]['item_id'];
            $issued_quantity = $item[$i]['issued_quantity'];
            $requested_quantity = $item[$i]['requested_quantity'];
            
            ItemRis::updateOrCreate([
                'control_no' => $control_no,
                'item_id' => $item_id,
            ],[
                'issued_quantity' => $issued_quantity,
            ]);
        }

        return response()->json();

    }

    public function store(Request $request){

        $control_no = $this->control_no();
        $batch = $request->batches;

        Ris::create([
            'control_no' => $control_no,
            'ris_date' => Carbon::today(),
            // 'requested_by' => auth('api')->user()->id,
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
            // 'issued_by' => auth('api')->user()->id,
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
            // 'received_by' => $request->user_id,
            'received_date' => Carbon::today(),
        ]);

        return response()->json();
    }

    

    public function show($id){

        $ris =  Ris::findOrFail($id);

        $data = new RisResource(Ris::find($id));

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
