<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attachment;

class AttachmentController extends Controller
{
    public function index(){
        $data = Attachment::orderBy('attachment_desc', 'asc')->get();

        return response()->json($data);
    }

    public function store(Request $request){

        $attachment = Attachment::firstOrCreate([
            'attachment_desc' => $request->attachment_desc,
        ]); 

        return response()->json();
    }

    public function update(Request $request, $id){
        
    }
}
