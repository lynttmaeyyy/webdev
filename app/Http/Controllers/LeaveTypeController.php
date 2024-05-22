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
            'leavetype' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        
        $leavetype->name = $validatedData['leavetype'];
        $leavetype->description = $validatedData['description'];
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
            'leavetype' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $leavetype = new LeaveType();
        $leavetype->name = $validatedData['leavetype'];
        $leavetype->description = $validatedData['description'];
        $leavetype->user_id = auth()->id();
        $leavetype->save();

        return response()->json(['message' => 'LeaveType added successfully'], 200);
    }

    public function index()
        {
            $leavetypes = LeaveType::all();
            return view('pages.icons', compact('leavetypes'));
        }

}