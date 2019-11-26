<?php

namespace App\Http\Controllers\PMO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PMO\PoItem;
use App\Http\Resources\PMO\PoItem as PoItemResource;

class PoItemController extends Controller
{
    public function index(){
        

    }

    public function store(){


    }

    public function po_details($id){

        $data = PoItem::where('po_id', $id)->get();

        return response()->json($data);

    }

    public function show(){


    }

    public function update(){


    }

    public function destroy(){


    }
}
