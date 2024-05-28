<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Employee;
use App\Models\Department;
use App\Models\User;

class EmployeeController extends Controller
{
    public function edit($id)
    { 
        $id = Crypt::decryptString($id);
        $employee = Employee::leftJoin('users','users.id','=','employees.user_id')->where('employees.id',$id)->get();
        return response()->json($employee);
    }

    public function update(Request $request, $id)
    {    
        $id = Crypt::decryptString($id);
        $employee = Employee::findOrFail($id);  

        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'middlename' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phonenumber' => 'required',
            'department' => 'required|string|max:255',
            'email' => 'required|unique:users,email,'.$request->user_id,
        ]);

        
        $employee->first_name = $validatedData['firstname'];
        $employee->middle_name = $validatedData['middlename'];
        $employee->last_name = $validatedData['lastname'];
        $employee->gender = $validatedData['gender'];
        $employee->address = $validatedData['address'];
        $employee->phone_number = $validatedData['phonenumber'];
        $employee->department = $validatedData['department'];
        $employee->save();

        $user = User::find($employee->user_id);
        $user->email = $validatedData['email'];
        if(!empty($request->password)){
            $validatedData = $request->validate([
                'password' => [
                    'required',
                    'min:5',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'
                ],
            ], [
                'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, and one number.',
            ]);
            $user->password = $validatedData['password'];
        }
        $user->save();
        return response()->json($employee);
    }

    public function destroy($id)
    { 
        $id = Crypt::decryptString($id);
        $employee = Employee::findOrFail($id);
        $employee->delete();
        
        $user = User::findOrFail($employee->user_id);
        $user->delete();
        
        return response()->json(['message' => 'Employee deleted successfully']);
    }
    

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'middlename' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|unique:users,email',
            'phonenumber' => 'required',
            'department' => 'required|string|max:255',
            'password' => [
                'required',
                'min:5',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'
            ],
        ], [
            'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, and one number.',
        ]);

        $user = new User();
        $user->name = $validatedData['firstname'].' '.$validatedData['lastname'];
        $user->email = $validatedData['email'];
        $user->password = $validatedData['password'];
        $user->save();

        $employee = new Employee();
        $employee->first_name = $validatedData['firstname'];
        $employee->middle_name = $validatedData['middlename'];
        $employee->last_name = $validatedData['lastname'];
        $employee->gender = $validatedData['gender'];   
        $employee->address = $validatedData['address'];
        $employee->phone_number = $validatedData['phonenumber'];
        $employee->department = $validatedData['department'];
        $employee->user_id = $user->id;
        $employee->save();


        return response()->json(['message' => 'Employee added successfully'], 200);
    }

    public function index()
        {
            $employees = Employee::all();
            $departments = Department::all();
            return view('pages.map', compact('employees','departments'));
        }

}