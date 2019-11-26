<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PurchaseRequest;
use App\Models\PurchaseRequestDetail;
use Carbon\Carbon;
use App\Http\Resources\PurchaseRequest as PurchaseRequestResource;
use App\Models\Item;
use App\Models\Category;

class PurchaseRequestController extends Controller
{

    public function index(){
        $data = PurchaseRequestResource::collection(PurchaseRequest::orderBy('pr_no', 'desc')->get());

        return response()->json($data);
    }

    public function pr(){
        $now = Carbon::now();
        $year_now = $now->year;
        $month_now = $now->month;
        $month = sprintf('%02d', $month_now);
        $year_month = $year_now.'-'.$month;
        $count = PurchaseRequest::whereYear('created_at', $year_now)->count();

        if ($count > 0) {
            $last_p = PurchaseRequest::orderBy('pr_no', 'desc')->first();
            $last_p_no = substr($last_p->pr_no, -4);
            $new = (int)$last_p_no + 1;
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

        $category_id = $request->category_id;
        $purpose = $request->purpose;

        PurchaseRequest::create([
            'pr_no' => $pr_no,
            'user_id' => auth('api')->user()->id,
            'purpose' => $purpose,
            'category_id' => $category_id,
        ]);

        $this->details($pr_no, $item, $category_id);

        return response()->json();
    }

    public function item_id($category_id){

        $category = Category::where('category_id', $category_id)->first();
        $acronym = $category->acronym;

        $last_item = Item::orderBy('item_id', 'desc')->first();
        $last_item_id = (int)(substr($last_item->item_id, -5));
        $new_item_id = $acronym.'-'.sprintf('%05d',($last_item_id + 1));

        return $new_item_id;
    }

    public function details($pr_no, $item, $category_id){

        $count = count($item);
        
        for($i = 0; $i < $count; $i++){

            $cost = (float)$item[$i]['cost'];
            $quantity = (int)$item[$i]['quantity'];
            $item_id = $item[$i]['item_id'];
            
            if($item_id === null){
                
                $new_item_id = $this->item_id($category_id);

                $item = Item::create([
                    'item_id' => $new_item_id,
                    'item_desc' => $item[$i]['item_desc'],
                    'unit_desc' => $item[$i]['unit_desc'],
                    'category_id' => $category_id,
                ]);
                
                $item_id = $item->item_id;
            }
 
            PurchaseRequestDetail::create([
                'pr_no' => $pr_no,
                'item_id' => $item_id,
                'cost' => $cost,
                'quantity' => $quantity,
            ]);
        }

        return true;
    }

    public function update(Request $request, $id){
    
        $item = $request->items;

        $pr = PurchaseRuquest::findOrFail($id);
        $pr->update([
            'purpose' => $request->purpose,
        ]);

        $pr->details()->delete();

        $this->details($id, $item, $pr->category_id);    
    
    }

    public function update_details(){



    }

    public function show($id){

        $pr = PurchaseRequest::where('pr_no', $id)->first();
        if($pr === null){
            $data = [
                'pr_no' => null,
            ];
        } else {
            $data = new PurchaseRequestResource($pr);
        }

        return response()->json($data);
        
    }

    public function check_pr_if_exists(Request $request){

        $pr = new PurchaseRequestResource(PurchaseRequest::where('pr_no', $request->pr_no)-first());

        return response()->json($pr);
    }

    public function destroy($id){

    }

    public function search_pr(Request $request){

        $prs = PurchaseRequest::where('pr_no', 'like', '%'.$request->word.'%')->get();

        $data = PurchaseRequestResource::collection($prs);

        return response()->json($data);
    }
}
