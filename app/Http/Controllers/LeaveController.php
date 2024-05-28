<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leave;
use App\Models\LeaveType;
use Illuminate\Support\Carbon;

class LeaveController extends Controller
{
    function index(){
        $leaves = Leave::leftJoin('users','users.id','=','leaves.user_id')
                        ->leftJoin('leave_types','leave_types.id','=','leaves.leave_type')
                        ->where('leaves.status','pending')
                        ->select('leaves.*','users.name', 'leave_types.name as leavetypename')
                        ->get();
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

        $now = now()->format('Y');
        
        $LeaveTypes = [];

        $LeaveTypesarrays = LeaveType::all();
        $Leaves = Leave::whereYear('created_at',$now)
                        ->whereIn('status',['pending','approved'])
                        ->count();
        
        foreach($LeaveTypesarrays as $LeaveTypesarray){
            $totaltypeleave = Leave:: where('leaves.leave_type',$LeaveTypesarray->id)
                                ->whereYear('leaves.created_at', $now)
                                ->whereIn('status',['pending','approved'])
                                ->count();

            $leaveType = [
                'id' => $LeaveTypesarray->id,
                'name' => $LeaveTypesarray->name,
                'remaining' => $LeaveTypesarray->numtype - $totaltypeleave,
            ];

            // $leaveTypes['name'] =  $LeaveTypesarray->name ;
            // $leaveTypes['remaining'] =  $totaltypeleave ;
            $LeaveTypes[] =  $leaveType ;
        }
        return view( 'users.fileleave', compact('LeaveTypes','Leaves'));
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
