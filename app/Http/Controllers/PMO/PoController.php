<?php

namespace App\Http\Controllers\PMO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PMO\Po;
use App\Http\Resources\PMO\Po as PoResource;
use App\Http\Resources\PMO\PoWithIar as PoWithIarResource;
use App\Views\PmoPo as ViewPmoPo;

class PoController extends Controller
{
    public function index(){
        $data = PoResource::collection(ViewPmoPo::where('id', '<>', 113)
        ->where('id', '<>', 822)
        // ->where('ors_burst', '<>', '')
        ->orderBy('po_no', 'desc')
        ->get());

        return response()->json($data);
    }

    public function store(Request $request){

        

    }

    public function search_po(Request $request){
        $word = (string)$request->search_word;

        $data = PoResource::collection(Po::where('po_no', 'like', '%' . $word . '%')->orderBy('po_no', 'desc')->get());

        return response()->json($data);
    }

    public function show($id){
        $data = new PoWithIarResource(ViewPmoPo::find($id));

        return response()->json($data);
    }

    public function update_obrs(Request $request, $id){
        $po = Po::where('po_no', $id)->first();
        $po->update([
            'ors_burst' => $request->obrs
        ]);

        return response()->json($request->obrs);
    }

    public function update_fund_cluster(Request $request, $id){
        $po = Po::where('po_no', $id)->first();
        $po->update([
            'ors_burst_fund' => $request->fund_cluster
        ]);

        return response()->json($request->fund_cluster);
    }

    public function update(Request $request, $id){

    }

    public function destroy($id){


    }
}
