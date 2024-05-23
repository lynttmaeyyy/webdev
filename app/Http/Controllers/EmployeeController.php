<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function edit($id)
    { 
        $employee = Employee::findOrFail($id);
        return response()->json($employee);
    }

    public function update(Request $request, $id)
    {    
        $employee = Employee::findOrFail($id);  

        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|integer',
            'department' => 'required|string|max:255',

        ]);

        
        $employee->first_name = $validatedData['first_name'];
        $employee->middle_name = $validatedData['middle_name'];
        $employee->last_name = $validatedData['last_name'];
        $employee->gender = $validatedData['gender'];
        $employee->address = $validatedData['address'];
        $employee->phone_number = $validatedData['phone_number'];
        $employee->department = $validatedData['department'];
        $employee->save();

        return response()->json($employee);
    }

    public function destroy($id)
    { 
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return response()->json(['message' => 'Employee deleted successfully']);
    }
    

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|integer',
            'department' => 'required|string|max:255',
        ]);

        $employee = new Employee();
        $employee->first_name = $validatedData['first_name'];
        $employee->middle_name = $validatedData['middle_name'];
        $employee->last_name = $validatedData['last_name'];
        $employee->gender = $validatedData['gender'];   
        $employee->address = $validatedData['address'];
        $employee->phone_number = $validatedData['phone_number'];
        $employee->department = $validatedData['department'];
        $employee->save();

        return response()->json(['message' => 'Employee added successfully'], 200);
    }

    public function index()
        {
            $employees = Employee::all();
            return view('pages.map', compact('employees'));
        }

}