<?php

namespace App\Http\Controllers\MMO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MMO\Attachment;

class AttachmentController extends Controller
{
    public function index(){

        $attachments = Attachment::orderBy('attachment_desc', 'asc')->get();

        return response()->json($attachments);
    }

    public function store(Request $request){

        $attachment = Attachment::firstOrCreate([
            'attachment_desc' => $request->attachment_desc,
        ]);

        return response()->json($attachment);
    }

    public function show($id){
        $attachment = Attachment::findOrFail($id);

        return response()->json($attachment);
    }

    public function update(Request $request, $id){
        $attachment = Attachment::findOrFail($id);
        $attachment->update([
            'attachment_desc' => $request->attachment_desc,
        ]);

        return response()->json();
    }

    public function destroy($id){
        

    }
}
