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

    }

    // single detail api
    public function getSingleEmployee(Employee $employee) {

    }

    // update api
    public function updateEmployee(Employee $employee) {

    }

    //  delete api
    public function deleteEmployee() {

    }
}
