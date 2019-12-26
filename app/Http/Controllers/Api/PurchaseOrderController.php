<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use Carbon\Carbon;
use App\Http\Resources\PurchaseOrder as PurchaseOrderResource;
use App\Models\Supplier;
use App\Models\Brand;
use App\Models\Packaging;
use App\Models\Country;
use App\Models\Manufacturer;

class PurchaseOrderController extends Controller
{
    public function index(){
        $data = PurchaseOrderResource::collection(PurchaseOrder::orderBy('po_no', 'desc')->take(100)->get());

        return response()->json($data);
    }
    


    public function new_po(){

        $now = Carbon::now();
        $year_now = $now->year;
        $month_now = $now->month;
        $month = sprintf('%02d', $month_now);
        $year_month = $year_now.'-'.$month;
        $count = PurchaseOrder::whereYear('created_at', $year_now)->count();

        if ($count > 0) {
            $last_po = PurchaseOrder::orderBy('po_no', 'desc')->first();
            $last_po_no = substr($last_po->po_no, -4);
            $new = (int)$last_po_no + 1;
            $new_po_no = sprintf('%04d', $new);
            $po_no = $year_month.'-'.$new_po_no;
        } else {
            $po_no = $year_month.'-'.'0001';
        }

        return $po_no;

    }

    public function store(Request $request){

        $item = $request->items;
        $po_no = $this->new_po();
        $mode_id = $request->mode_id;
        $supplier_id = $request->supplier_id;
        $supplier_name = $request->supplier_name;
        $supplier_address = $request->supplier_address;
        $days = $request->days;
        $served_date = $request->served_date;

        if($supplier_id === null){
            $supplier = Supplier::Create([
                'supplier_name' => $supplier_name,
                'supplier_address' => $supplier_address,
            ]);

            $supplier_id = $supplier->supplier_id;
        }
        
        PurchaseOrder::create([ 
            'po_no' => $po_no,
            'pr_no' => $request->pr_no,
            'supplier_id' => $supplier_id,
            'user_id' => auth('api')->user()->id,
            'mode_id' => $mode_id,
            'served_date' => $served_date,
            'days' => $days,
        ]);

        $this->details($po_no, $item);

        
    }

    public function details($po_no, $item){
        $count = count($item);
        for($i = 0; $i < $count; $i++){

            $item_id = $item[$i]['item_id'];
            $cost = $item[$i]['cost'];
            $quantity = $item[$i]['quantity'];
            $offer = $item[$i]['offer'];
            $other_details = $item[$i]['other_details'];


            $brand = Brand::firstOrCreate([
                'brand_desc' => $item[$i]['brand_desc'],
            ]);
            
            $manufacturer = Manufacturer::firstOrCreate([
                'manufacturer_desc' => $item[$i]['manufacturer_desc'],
            ]);

            $country = Country::firstOrCreate([
                'country_desc' => $item[$i]['country_desc'],
            ]);

            $packaging = Packaging::firstOrCreate([
                'packaging_desc' => $item[$i]['packaging_desc'],
            ]);

            $brand_id = $brand->brand_id;
            $country_id = $country->country_id;
            $manufacturer_id = $manufacturer->manufacturer_id;
            $packaging_id = $packaging->packaging_id;

            // $brand_id = $item[$i]['brand_id'];
            // $manufacturer_id = $item[$i]['manufacturer_id'];
            // $packaging_id = $item[$i]['packaging_id'];
            // $country_id = $item[$i]['country_id'];

            PurchaseOrderDetail::create([
                'po_no' => $po_no,
                'item_id' => $item_id,
                'cost' => $cost,
                'quantity' => $quantity,
                'brand_id' => $brand_id,
                'manufacturer_id' => $manufacturer_id,
                'packaging_id' => $packaging_id,
                'country_id' => $country_id,
                'offer' => $offer,
                'other_details' => $other_details,
            ]);
        }

        return response()->json($po_no);
    }

    public function show($id){
        $data = new PurchaseOrderResource(PurchaseOrder::find($id));

        return response()->json($data);
    }

    public function search_po(Request $request){
        $word = (string)$request->search_word;
        $pos = PurchaseOrder::where('po_no', 'like', '%' . $word . '%')->orderBy('po_no', 'desc')->get();
        $data = PurchaseOrderResource::collection($pos);

        return response()->json($data);
    }
}
