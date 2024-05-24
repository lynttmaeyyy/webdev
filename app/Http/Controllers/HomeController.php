<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Leave;
use App\Models\LeaveType;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if(auth()->user()->role == 'admin'){
            if (view()->exists("pages.dashboard")) {
                $employees = Employee::all();
                $leaves = Leave::leftJoin('users','users.id','=','leaves.user_id')->select('leaves.*','users.name')->get();
                $leavePending = Leave::where('status','pending')->count();
                $leaveApproved = Leave::where('status','approved')->count();
                return view('pages.dashboard',compact('employees','leaves','leavePending','leaveApproved'));
            }
        }
        if(auth()->user()->role == 'employee'){
            if (view()->exists("users.dashboard")) {
                // $employees = Employee::all();
                $leaves = Leave::where('leaves.user_id','=', auth()->id())
                                ->get();
                $LeaveTypes = LeaveType::all();
                // $leavePending = Leave::where('status','pending')->count();
                // $leaveApproved = Leave::where('status','approved')->count();
                return view('users.dashboard',compact('leaves','LeaveTypes'));
            }
        }
        

        return abort(404);
        
        // $employees = Employee::all();
        // $leaves = Leave::all();
        // $leavePending = Leave::where('status','pending')->count();
        // $leaveApproved = Leave::where('status','approved')->count();
        // return view('pages.dashboard',compact('employees','leaves','leavePending','leaveApproved'));
        // return view('pages.dashboard');
    }

    // public function employee()
    //     {
    //         $employees = Employee::all();
    //         return view('employees', compact('employees'));
    //     }
}
