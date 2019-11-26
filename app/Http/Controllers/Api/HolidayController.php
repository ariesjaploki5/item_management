<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Holiday;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;

class HolidayController extends Controller
{
    public function index(){
        $holidays = Holiday::orderBy('holiday_date', 'asc')->get();

        return $holidays;
    }

    public function store(Request $request){
        $holiday = Holiday::firstOrCreate([
            'holiday_date' => $request->holiday_date,
            'holiday_desc' => $request->holiday_desc,
        ]);

        return response()->json();
    }

    public function show($id){
        $holiday = Holiday::findOrFail($id);
        
        return $holiday;
    }

    public function update(Request $request, $id){
        $holiday = Holiday::find($id);
        $holiday->update([
            'holiday_date' => $request->holiday_date,
            'holidy_desc' => $request->holiday_desc,
        ]);

        return response()->json();
    }

    public function destroy($id){
        $holiday = Holidy::where('holiday_date', $id)->first();
        $holiday-delete();
        
        return response()->json();
    }
}
