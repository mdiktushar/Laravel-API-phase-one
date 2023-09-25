<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    // create API
    public function createEmployee(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required | email | unique:employees',
            'phone_no' => 'required',
            'gender' => 'required',
            'age' => 'required'
        ]);

        $employee = new Employee();
        
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone_no = $request->phone_no;
        $employee->gender = $request->gender;
        $employee->age = $request->age;

        $employee->save();

        return response()->json([
            'status' => 1,
            'message' => 'employee created successfully',
        ]);
    }

    // list api
    public function listEmployees() {
        $employee = Employee::all();

        return response()->json([
            'status' => 200,
            'message' => "Listing Employees",
            'data' => $employee,
        ]);
    }

    // single detail api
    public function getSingleEmployee($id) {
        if(Employee::where('id', $id)->exists()) {
            $employee = Employee::findOrFail($id);
            return response()->json([
                'status' => 200,
                'message' => "Employee found",
                'data' => $employee,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "Employee not found",
            ], 404);
        }
        
    }

    // update api
    public function updateEmployee(Request $request, $id) {
        if (Employee::where('id', $id)->exists()) {
            $employee = Employee::find($id);

            $employee->name = empty($request->name) ? $employee->name : $request->name;
            $employee->email = empty($request->email) ? $employee->email : $request->email;
            $employee->phone_no = empty($request->phone_no) ? $employee->phone_no : $request->phone_no;
            $employee->gender = empty($request->gender) ? $employee->gender : $request->gender;
            $employee->age = empty($request->age) ? $employee->age : $request->age;

            $employee->save();

            return response()->json([
                'status' => 200,
                'message' => "Employee Updated successfully",
                'data' => $employee,
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "Employee not found",
            ], 404);
        }
    }

    //  delete api
    public function deleteEmployee($id) {
        if (Employee::where('id', $id)->exists()) {
            $employee = Employee::find($id);
            $employee->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "Employee not found",
            ], 404);
        }
    }
}
