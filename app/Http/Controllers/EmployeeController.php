<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Employees;

class EmployeeController extends Controller
{
    public function getEmployee($id) {
        $employee = Employees::where('company_id', '=', $id)->paginate(10);

        if(is_null($employee)) {
            return response()->json(['msg' => 'employees not found'], 404);
        }
        return response()->json($employee, 200);

    }

    public function getEmployeeById($id) {
        $employee = Employees::find($id);
        if(is_null($employee)) {
            return response()->json(['msg' => 'Employee not found'], 404);
        }
        return response()->json($employee, 200);
    }

    public function addEmployee(Request $request) {

        request()->validate([
            'company_id'=> 'required',
            'firstname' => 'required',
            'lastname'  => 'required',
            'email'     => 'required',
            'phone'     => 'required'
        ]);

        $employee = Employees::create($request->all());

        return response($employee, 201);

    }

    public function updateEmployee(Request $request, $id) {

        $employee = Employees::find($id);
        if(is_null($employee)) {
            return response()->json(['msg' => 'Employee not found'], 404);
        }
        $employee->update($request->all());
        return response($employee, 200);

    }

    public function deleteEmployee(Request $request, $id) {

            $employee = Employees::find($id);
            if(is_null($employee)) {

                return response()->json(['msg' => 'Employee not found'], 404);

            }

            $employee->delete();
            return response()->json(null, 204);
    }

}