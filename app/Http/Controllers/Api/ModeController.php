<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mode;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Response;

class ModeController extends Controller
{
    public function index(){
        $modes = Mode::orderBy('mode_desc', 'asc')->get();

        return response()->json($modes);
    }

    public function store(Request $request){


    }

    public function show($id){


    }

    public function update(Request $request, $id){


    }

    public function destroy($id){

        
    }
}
