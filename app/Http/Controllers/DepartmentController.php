<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function edit($id)
    { 
        $department = Department::findOrFail($id);
        return response()->json($department);
    }

    public function update(Request $request, $id)
    {    
        $department = Department::findOrFail($id);  

        $validatedData = $request->validate([
            'department_name' => 'required|string|max:255',
            'department_shortname' => 'required|string|max:255',

        ]);

        
        $department->department_name = $validatedData['department_name'];
        $department->department_shortname = $validatedData['department_shortname'];
        $department->save();

        return response()->json($department);
    }

    public function destroy($id)
    { 
        $department = Department::findOrFail($id);
        $department->delete();
        return response()->json(['message' => 'Department deleted successfully']);
    }
    

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'department_name' => 'required|string|max:255',
            'department_shortname' => 'required|string|max:255',

        ]);

        $department = new Department();
        $department->department_name = $validatedData['department_name'];
        $department->department_shortname = $validatedData['department_shortname'];
        $department->save();

        return response()->json(['message' => 'Department added successfully'], 200);
    }

    public function index()
        {
            $departments = Department::all();
            return view('profile.edit', compact('departments'));
        }

}