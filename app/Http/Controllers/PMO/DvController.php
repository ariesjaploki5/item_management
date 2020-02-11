<?php

namespace App\Http\Controllers\PMO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\PMO\PoAttachment;

use App\PMO\Dv;
use Carbon\Carbon;
use App\PMO\DvLiquidatedDamage;

class DvController extends Controller
{

    public function index(){
        $data = Dv::orderBy('dv_no', 'desc')->get();

        return response()->json($data);
    }

    public function new_dv(){
        $now = Carbon::now();
        $year_now = $now->year;
        $month_now = $now->month;
        $month = sprintf('%02d', $month_now);
        $year_month = $year_now.'-'.$month;
        $count = Dv::whereYear('created_at', $year_now)->count();

        if ($count > 0) {

            $last_dv = Dv::orderBy('dv_no', 'desc')->first();
            $last_dv_no = substr($last_dv->dv_no, -4);
            $new = (int)$last_dv_no + 1;
            $new_dv_no = sprintf('%04d', $new);
            $dv_no = $year_month.'-'.$new_dv_no;

        } else {
            $dv_no = $year_month.'-'.'0001';
        }

        return $dv_no;

    }

    public function store(Request $request){

        $liquidated_damage = $request->liquidated_damages;
        $attachment = $request->attachments;

        $dv = Dv::create([
            'po_no' => $request->po_no,
            'dv_no' => $this->new_dv(),
            'approving_officer_id' => $request->approving_officer_id,
        ]);

        $this->dv_liquidated_damage($dv->dv_no, $liquidated_damage);

        return response()->json();
    }

    public function dv_liquidated_damage($dv_no, $liquidated_damage){

        $count = count($liquidated_damage);

        for($i = 0;$i < $count; $i++){
            DvLiquidatedDamage::firstOrCreate([
                'dv_no' => $dv_no,
                'liquidated_damage' => $liquidated_damage[$i]['iar_id'],
                'tax' => $liquidated_damage[$i]['liquidated_damage']
            ]);
        }
        return true;
    }

    public function store_po_attachment(Request $request){

        $po_attachment = PoAttachment::firstOrCreate([
            'po_no' => $request->po_no,
            'attachment_id' => $request->attachment_id,
        ],[
            'number_date_particulars' => $request->number_date_particulars,
        ]);

        return response()->json();
    }

    public function update(Request $request, $id){


    }

    public function liquidated_damages($id){

        $data = DB::table('mmo.dbo.tfn_pmo_po_iars()')->where('po_no', $id)->get();

        return response()->json($data);

    }

    public function po_attachments($id){

        $data = PoAttachment::with('attachment')->where('po_no', $id)->get();

        return response()->json($data);

    }

    public function show($id){


        
    }

    public function destroy($id){



    }
}
