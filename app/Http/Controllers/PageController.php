<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\LeaveType;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display all the static pages when authenticated
     *
     * @param string $page
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if(auth()->user()->role == 'admin'){
            if (view()->exists("pages.dashboard")) {
                $employees = Employee::all();
                $leaves = Leave::leftJoin('users','users.id','=','leaves.user_id')
                                 ->leftJoin('leave_types','leave_types.id','=','leaves.leave_type')
                                 ->select('leaves.*','users.name', 'leave_types.name as leavetypename')
                                 ->get();
                $leavePending = Leave::where('status','pending')->count();
                $leaveApproved = Leave::where('status','approved')->count();
                return view('pages.dashboard',compact('employees','leaves','leavePending','leaveApproved'));
            }
        }
        if(auth()->user()->role == 'employee'){
            if (view()->exists("users.dashboard")) {
                // $employees = Employee::all();
                $leaves = Leave::leftJoin('leave_types','leave_types.id','=','leaves.leave_type')
                                ->select('leaves.*','leave_types.name as leavetypename')
                                ->where('leaves.user_id','=', auth()->id())
                                ->get();
                $LeaveTypes = LeaveType::all();
                // $leavePending = Leave::where('status','pending')->count();
                // $leaveApproved = Leave::where('status','approved')->count();
                return view('users.dashboard',compact('leaves','LeaveTypes'));
            }
        }
        

        return abort(404);
    }
}
