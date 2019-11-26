<?php

namespace App\Http\Controllers\MMO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MMO\Dv;
use App\MMO\AttachmentDv;
use App\Http\Resources\Dv as DvResource;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;

class DvController extends Controller
{
    public function index(){
        $dvs = DvResource::collection(Dv::all());

        return response()->json($dvs);
    }

    public function dv(){
        $now = Carbon::now();
        $year_now = $now->year;

        $count = Dv::whereYear('created_at', $year_now)->count();

        if($count > 0){
            $last_dv = Dv::orderBy('dv_no', 'desc')->first();
            $last_dv_no = substr($last_dv->dv_no, -4);
            $new = (int)$last_dv_no + 1;
            $new_dv_no = sprintf('%04d', $new);
            $dv_no = $year_now.'-'.$new_dv_no;
        } else {
            $dv_no = $year_now.'-'.'0001';
        }

        return $dv_no;
        
    }

    public function store(Request $request){
        $attachment = $request->attachments;
        $dv_no = $this->dv();

        Dv::firstOrcreate([
            'dv_no' => $dv_no,
            'po_no' => $request->po_no,
            'approving_officer_id' => $request->approving_officer_id,
        ]);

        $this->attachment_dvs($attachment, $dv_no);
    }

    public function attachment_dvs($attachment, $dv_no){
        $count = count($attachment);
        
        for($i= 0; $i < $count; $i++){
            $attachment_id = $attachment[$i]['attachment_id'];
            $number_date_particulars = $attachment[$i]['number_date_particulars'];

            AttachmentDv::firstOrCreate([
                'attachment_id' => $attachment_id,
                'dv_no' => $dv_no,
                'number_date_particulars' => $number_date_particulars,
            ]);
        }
        return response()->json();
    }

    public function show($id){
        $dv = DV::findOrFail($id);

        return response()->json($dv);
    }

    public function update(Request $request, $id){


    }

    public function destroy($id){

        
    }
}
