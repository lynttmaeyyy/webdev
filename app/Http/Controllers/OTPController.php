<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTPMail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class OTPController extends Controller
{
    public function generateOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        }
        $subject = "Send OTP";
        $otp = strval(random_int(100000, 999999));

        $request->session()->put('otp', $otp);

        Mail::to($request->email)->send(new OTPMail(request('email'),$otp,$subject));

        return response()->json(['message' => 'success']);
    }

    public function verifyOTP(Request $request)
    {
        $otp = $request->otp;
        $storedOTP = Session::get('otp');

        if ($otp === $storedOTP) {
            Session::forget('otp');
            return response()->json(['message' => 'success']);
        } else {
            return response()->json(['error' => 'Invalid OTP']);
        }
    }
}
