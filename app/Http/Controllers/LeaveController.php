<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leave;
use App\Models\LeaveType;

class LeaveController extends Controller
{
    function index(){
        $leaves = Leave::leftJoin('users','users.id','=','leaves.user_id')->select('leaves.*','users.name')->get();
        return view(
            'pages.leaves',
            compact('leaves')
        );
    }

    public function reject($id){

        $leave = Leave::find($id);

        $leave->status = 'rejected';
        $leave->save();

        return response()->json(['message'=>'Leave successfully rejected']);
    }
    public function approve($id){

        $leave = Leave::find($id);

        $leave->status = 'approved';
        $leave->save();

        return response()->json(['message'=>'Leave successfully approved']);
    }
    public function getleave($id){

        $leave = Leave::find($id);

        return response($leave);
    }

    function fileleave(){
        $LeaveTypes = LeaveType::all();
        return view( 'users.fileleave', compact('LeaveTypes'));
    }

    function store(){
        $data = request()->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'leave_type' => 'required',
            'reason' => 'required|max:255'
        ]);
        $data['user_id'] = auth()->id();

        Leave::create($data);

        return response()->json(['message'=>'Leave successfully added']);
    }
    function save(){

        $data = request()->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'leave_type' => 'required',
            'reason' => 'required|max:255'
        ]);


        $leave = Leave::find(request()->leaveID);
        $leave->start_date = $data['start_date'];
        $leave->end_date = $data['end_date'];
        $leave->leave_type = $data['leave_type'];
        $leave->reason = $data['reason'];
        $leave->save();

        return response()->json(['message'=>'Leave successfully save!']);
    }

    function Delete($leaveID){

        $leave = Leave::find($leaveID);
        $leave->delete();

        return response()->json(['message'=>'Leave successfully deleted!']);
    }
}
