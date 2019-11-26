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
