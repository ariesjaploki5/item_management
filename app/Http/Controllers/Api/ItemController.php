<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Item;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use App\Http\Resources\Item as ItemResource;
use App\Http\Resources\ItemStock as ItemStockResource;

use App\Http\Resources\ItemView as ItemViewResource;
use App\Http\Resources\BatchView as BatchViewResource;

use App\Views\Item as ItemView;
use App\Views\Batch as BatchView;

class ItemController extends Controller
{
    public function index(){
        
        // $items = ItemResource::collection(Item::with('category', 'batches')->orderBy('item_id', 'asc')->get());
        // $items = ItemStockResource::collection(DB::table("mmo.dbo.tfn_items()")->get());

        $items = ItemView::with([
            'batches' => function($q){
                $q->orderBy('expiration_date', 'asc');
            },
        ])->get();

        $data = ItemViewResource::collection($items);

        return response()->json($data);

    }

    public function drugs_and_medicines(){
        $items = DB::select("select 
        sc.sl_code, 
        item_desc = min(item.item_desc),
        stock = sum(eus.quantity)
        from mmo.dbo.items_2 as item left outer join
        mmo.dbo.sl_codes as sc on item.item_id = sc.item_id
        left outer join
        mmo.dbo.end_user_stock as eus on eus.sl_code = sc.sl_code
        where item.category_id = 1
        group by sc.sl_code");

        // $data = ItemViewResource::collection($items);

        return response()->json($items);
    }

    public function medical_supplies(){
        $items = DB::select("select 
        sc.sl_code, 
        item_desc = min(item.item_desc),
        stock = sum(eus.quantity)
        from mmo.dbo.items_2 as item left outer join
        mmo.dbo.sl_codes as sc on item.item_id = sc.item_id
        left outer join
        mmo.dbo.end_user_stock as eus on eus.sl_code = sc.sl_code
        where item.category_id = 2
        group by sc.sl_code");

        // $data = ItemViewResource::collection($items);

        return response()->json($items);
    }

    public function office_supplies(){
        $items = DB::select("select 
        sc.sl_code, 
        item_desc = min(item.item_desc),
        stock = cast(sum(eus.quantity) as int)
        from mmo.dbo.items_2 as item left outer join
        mmo.dbo.sl_codes as sc on item.item_id = sc.item_id
        left outer join
        mmo.dbo.end_user_stock as eus on eus.sl_code = sc.sl_code

        group by sc.sl_code");


        return response()->json($items);        
    }
    
    public function other_supplies(){
        $items = DB::select("select 
        sc.sl_code, 
        item_desc = min(item.item_desc),
        stock = sum(eus.quantity)
        from mmo.dbo.items_2 as item left outer join
        mmo.dbo.sl_codes as sc on item.item_id = sc.item_id
        left outer join
        mmo.dbo.end_user_stock as eus on eus.sl_code = sc.sl_code
        where item.category_id = 6
        group by sc.sl_code");

        // $data = ItemViewResource::collection($items);

        return response()->json($items);
    }

    public function item_drugs_and_medicines(){
        // $items = ItemView::with([
        //     'batches' => function($q){
        //         $q->orderBy('expiration_date', 'asc');
        //     },
        // ])->where('category_id', 1)->get();

        // $data = ItemViewResource::collection($items);

        $items = DB::table("mmo.dbo.items_2")->where('category_id', 1)->get();

        return response()->json($items);
    }

    public function item_medical_supplies(){
        $items = DB::table("mmo.dbo.items_2")->where('category_id', 2)->get();

        return response()->json($items);
    }

    public function item_office_supplies(){
        $items = DB::table("mmo.dbo.items_2")->where('category_id', 5)->get();
        return response()->json($items);
    }

    public function item_other_supplies(){
        $items = DB::table("mmo.dbo.items_2")->where('category_id', 6)->get();

        return response()->json($items);
    }

    public function office_supplies_search($search_word){
        $items = ItemView::with([
            'batches' => function($q){
                $q->orderBy('expiration_date', 'asc');
            },
        ])->where('category_id', 5)
        ->where('item_desc', 'like', "%".$search_word."%")
        ->get();

        $data = ItemViewResource::collection($items);

        return response()->json($data);
    }

    public function check_item_if_exists(Request $request){
        // $item = Item::where('item_desc', $request->item_desc)->first();
        $item = DB::table('mmo.dbo.items')->where('item_desc', $request->item_desc)->orderBy('item_desc', 'asc')->first();

        if($item === null){

            $item = [
                'item_id' => null,
                'item_desc' => $request->item_desc,
                'unit_desc' => null,
            ];
        } 


        return response()->json($item);

    }

    public function store(Request $request){


    }

    public function per_category($id){

        $items = ItemView::with([
            'batches' => function($q){
                $q->orderBy('expiration_date', 'asc');
            },
        ])->where('category_id', $id)->get();

        $data = ItemViewResource::collection($items);

        return response()->json($data);

    }

    public function show($id){


    }

    public function update(Request $request, $id){


    }

    public function destroy($id){

        
    }
}
