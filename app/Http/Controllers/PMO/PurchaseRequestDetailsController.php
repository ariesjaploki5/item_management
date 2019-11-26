<?php

namespace App\Http\Controllers\PMO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PMO\PurchaseRequestDetails;

class PurchaseRequestDetailsController extends Controller
{

    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $prd = PurchaseRequestDetails::findOrFail($id);
        $prd->update([
            'quantity' => $request->quantity,
            'cost' => $request->cost,
            'remarks' =>$request->remarks,
        ]);

        return response()->json();
    }

    public function destroy($id)
    {
        //
    }
}
