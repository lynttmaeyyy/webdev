<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Leave;

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
        // $employees = Employee::all();
        // $leaves = Leave::all();
        // $leavePending = Leave::where('status','pending')->count();
        // $leaveApproved = Leave::where('status','approved')->count();
        // return view('pages.dashboard',compact('employees','leaves','leavePending','leaveApproved'));
        return view('pages.dashboard');
    }

    // public function employee()
    //     {
    //         $employees = Employee::all();
    //         return view('employees', compact('employees'));
    //     }
}
