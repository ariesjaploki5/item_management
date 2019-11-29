<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Views\Employee as EmployeeView;
use App\Http\Resources\Employee as EmployeeResource;

class EmployeeController extends Controller
{
    public function index(){
        $data = EmployeeResource::collection(EmployeeView::orderBy('department_id', 'asc')->orderBy('employee_id', 'asc')->get());

        return response()->json($data);
    }

    public function store(Request $request){

        $employee = Employee::firstOrCreate([
            'employee_id' => $request->employee_id,
            'employee_name' => $request->employee_name,
            'department_id' => $request->department_id,
        ]);

        return response()->json($employee);
    }

    public function show($id){
        $employee = new EmployeeResource(EmployeeView::findOrFail($id));

        return response()->json($employee);
    }

    public function update(Request $request, $id){

        $employee = Employee::findOrFaile($id);
        $employee->update([
            'employee_name' => $request->employee_name,
            'department_id' => $request->department_id,
        ]);

        return response()->json();
    }

    public function destroy($id){

        $employee = Employee::where('employee_id', $id)->first();
        $employee->delete();

        return response()->json();
    }
}
