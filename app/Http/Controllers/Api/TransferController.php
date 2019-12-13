<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\BatchRis;
use Carbon\Carbon;
use App\Models\Hdmhdrbrand;

class TransferController extends Controller
{
    public function pending(){
        $data = DB::table("SELECT 
                                br.control_no,
                                br.batch_no , 
                                i.item_id,
                                i.item_desc, 
                                bs.brand_desc, 
                                ih.dmdcomb,
                                ih.dmdctr,
                                br.issued_quantity, 
                                b.cost
                            from 
                            mmo.dbo.batch_ris as br left outer join
                            mmo.dbo.batches as b on br.batch_no = b.batch_no
                            left outer join
                            mmo.dbo.items as i on b.item_id = i.item_id
                            left outer join
                            mmo.dbo.brands as bs on b.brand_id = bs.brand_id
                            left outer join
                            mmo.dbo.item_hdmhdr as ih on ih.item_id = i.item_id")->get();
    
        return response()->json($data);
    }

    public function accept_batch($id){

        $br = DB::table("mmo.dbo.tfn_batches_to_transfer()")->where('batch_ris_id', $id)->first();

        $dmhdrsub = 'DRUMB';

        $transfer = Hdmhdrbrand::where('dmdcomb', $br->dmdcomb)
        ->where('dmdctr', $br->dmdctr)
        ->where('dmhdrsub', $dmhdrsub)
        ->where('brand_id', $br->brand_id)
        ->where('unit_price', $br->cost)
        ->where('selling_price', $br->cost/0.75)
        ->where('exp_date', $br->expiration_date)
        ->first();

        if($transfer === null){

            DB::table("mmo.dbo.hdmhdrbrands")->insert([
                'dmdcomb' => $br->dmdcomb, 
                'dmdctr' => $br->dmdctr, 
                'dmhdrsub' => 'DRUMB', 
                'brand_id' => $br->brand_id,
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
            ->where('brand_id', $br->brand_id)
            ->where('unit_price', $br->cost)
            ->where('exp_date', $br->expiration_date)
            ->where('selling_price', $br->cost/0.75)->update([
                'stockbal' => $transfer->stockbal + $br->issued_quantity,
                'updated_at' => Carbon::now()
            ]);
        }

        $br = DB::table("mmo.dbo.batch_ris")->where('batch_ris_id', $id)->update([
            'accepted' => 1,
        ]);
        
        return response()->json();
    }


}
