<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dv;
use App\Models\AttachmentDv;
use DB;


class DvController extends Controller
{
    public function index(){

    }

    public function new_dv(){

    }

    public function store(Request $request){

        $attachment = $request->attachments;
        $dv_no = $this->new_dv();
        
        DV::create([
            'dv_no' => $dv_no,
            
        ]);

        $this->attachment_dv($attachment, $dv_no);

        return response()->json();
    }

    public function attachment_dv($attachment, $dv_no){
        $count = count($attachment);

        for($i = 0; $i < $count; $i++){
            AttachmentDv::firstOrCreate([
                'dv_no' => $dv_no,
                'attachment_id' => $attachment[$i]['attachment_id'],
                'number_date_particulars' => $attachment[$i]['number_date_particulars'],
            ]);
        }

        return true;
    }

    public function update(){

    }

    public function destroy(){

    }
}
