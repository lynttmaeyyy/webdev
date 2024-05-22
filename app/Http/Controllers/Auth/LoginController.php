<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function ajaxLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return response()->json(['success' => true, 'message' => 'Login successful.']);
        }

        return response()->json(['success' => false, 'message' => 'Invalid credentials.'], 401);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return response()->json(['status' => 'success', 'message'=>'Login successful.']);
        }

        return response()->json(['status' =>  'error', 'message'=>'Invalid username or password.'], 401);
    }

    public function verify_login_email(Request $request)
    {
        $user = User::where('email', $request->email)->first();
  
        try {
            if ($user) {
                Auth::login($user);
                return response()->json(['status' => 'success']);
            }
            return response()->json(['status' => 'error', 'message' => 'Unauthorized Access!']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 429);
        }
    }
    
    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
    }

}
