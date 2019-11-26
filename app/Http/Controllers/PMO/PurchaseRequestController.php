<?php

namespace App\Http\Controllers\PMO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\PMO\PurchaseRequest;
use App\PMO\PurchaseRequestDetails;

class PurchaseRequestController extends Controller
{

    public function index()
    {
        
    }

    public function pr(){
        $now = Carbon::now();
        $year_now = $now->year;
        $month_now = $now->month;
        $month = sprintf('%02d', $month_now);
        $year_month = $year_now.'-'.$month;
        $count = PurchaseRequest::whereYear('created_at', $year_now)->count();

        if ($count > 0) {

            $last_pr = PurchaseRequest::orderBy('pr_no', 'desc')->first();
            $last_pr_no = substr($last_pr->pr_no, -4);
            $new = (int)$last_pr_no + 1;
            $new_pr_no = sprintf('%04d', $new);
            $pr_no = $year_month.'-'.$new_pr_no;

        } else {
            $pr_no = $year_month.'-'.'0001';
        }

        return $pr_no;
    }

    public function store(Request $request){

        $pr_no = $this->pr();
        $item = $request->items;
        $user_id = $request->user_id;
        $purpose = $request->purpose;

        PurchaseRequest::create([
            'pr_no' => $pr_no,
            'user_id' => $user_id,
            'purpose' => $purpose,
        ]);

        $this->store_pr_items($pr_no, $item);
    }

    public function store_pr_items($pr_no, $item){
        $count = count($item);

        for($i = 0; $i < $count; $i++){
            PurchaseRequestDetails::firstOrCreate([
                'pr_no' => $pr_no,
                'item_id' => $item[$i]['item_id'],
                'cost' => $item[$i]['cost'],
                'quantity' => $item[$i]['quantity'],
            ]);
        }

        return response()->json();
    }

    public function show($id)
    {
        
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        
    }
}
