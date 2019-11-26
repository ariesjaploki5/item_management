<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index(){
        $data = Supplier::orderBy('supplier_name', 'asc')->get();

        return response()->json($data);
    }

    public function store(Request $request){
        Supplier::firstOrCreate([
            'supplier_name' => $request->supplier_name,
            'supplier_address' => $request->supplier_address,
        ]);

        return response()->json();
    }

    public function update(Request $request, $id){

        $supplier =  Supplier::findOrFail($id);
        
        $supplier->update([
            'supplier_name' => $request->supplier_name,
            'supplier_address' => $request->supplier_address,
            'zip_code' => $request->zip_code,
            'tin' => $request->tin,
            'tax_registration' => $request->tax_registration,
            'business_form' => $request->business_form,
            'income_tax' => $request->income_tax,
            'tel_no' => $request->tel_no,
            'tax_id' => $request->tax_id,
        ]);

        return response()->json();
    }

    public function check_supplier_if_exists(Request $request){
        $supplier = Supplier::where('supplier_name', $request->supplier_name)->first();

        if($supplier === null){
            $supplier = [
                'supplier_id' => null,
                'supplier_name' => $request->supplier_name,
                'supplier_address' => null,
            ];
        }

        return response()->json($supplier);
    }
}
