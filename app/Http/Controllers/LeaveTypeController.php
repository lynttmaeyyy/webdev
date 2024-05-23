<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveType;

class LeaveTypeController extends Controller
{
    public function edit($id)
    { 
        $leavetype = LeaveType::findOrFail($id);
        return response()->json($leavetype);
    }

    public function update(Request $request, $id)
    {    
        $leavetype = LeaveType::findOrFail($id);  

        $validatedData = $request->validate([
            'leave_type' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            // 'last_name' => 'required|string|max:255',
            // 'gender' => 'required|string|max:255',
            // 'address' => 'required|string|max:255',
            // 'phone_number' => 'required|integer',
            // 'department' => 'required|string|max:255',

        ]);

        
        $leavetype->leave_type = $validatedData['leave_type'];
        $leavetype->description = $validatedData['description'];
        // $employee->last_name = $validatedData['last_name'];
        // $employee->gender = $validatedData['gender'];
        // $employee->address = $validatedData['address'];
        // $employee->phone_number = $validatedData['phone_number'];
        // $employee->department = $validatedData['department'];
        $leavetype->save();

        return response()->json($leavetype);
    }

    public function destroy($id)
    { 
        $leavetype = LeaveType::findOrFail($id);
        $leavetype->delete();
        return response()->json(['message' => 'LeaveType deleted successfully']);
    }
    

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'leave_type' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            // 'last_name' => 'required|string|max:255',
            // 'gender' => 'required|string|max:255',
            // 'address' => 'required|string|max:255',
            // 'phone_number' => 'required|integer',
            // 'department' => 'required|string|max:255',
        ]);

        $leavetype = new LeaveType();
        $leavetype->leave_type = $validatedData['leave_type'];
        $leavetype->description = $validatedData['description'];
        // $employee->last_name = $validatedData['last_name'];
        // $employee->gender = $validatedData['gender'];   
        // $employee->address = $validatedData['address'];
        // $employee->phone_number = $validatedData['phone_number'];
        // $employee->department = $validatedData['department'];
        $leavetype->save();

        return response()->json(['message' => 'LeaveType added successfully'], 200);
    }

    public function index()
        {
            $leavetypes = LeaveType::all();
            return view('pages.icons', compact('leavetypes'));
        }

}