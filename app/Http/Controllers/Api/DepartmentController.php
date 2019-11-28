<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index(){
        $data = Department::orderBy('department_desc', 'asc')->get();

        return response()->json($data);
    }

    public function store(Request $request){
        $department = Department::firstOrCreate([
            'department_desc' => $request->department_desc,
            'division_id' => $request->division_id,
        ]);

        return response()->json($department);
    }

    public function update(Request $request, $id){
        $department = Department::findOrFail($id);
        $department->update([
            'department_desc' => $request->department_desc,
            'division_id' => $request->division_id,
        ]);

        return response()->json();
    }

    public function destroy($id){
        $department = Department::where('department_id', $id)->first();
        $department->delete();

        return response()->json();
    }
}
