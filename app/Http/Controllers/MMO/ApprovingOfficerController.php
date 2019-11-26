<?php

namespace App\Http\Controllers\MMO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MMO\ApprovingOfficer;

class ApprovingOfficerController extends Controller
{
    
    public function index(){
        $data = ApprovingOfficer::orderBy('name', 'asc')->get();

        return response()->json($data);
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
