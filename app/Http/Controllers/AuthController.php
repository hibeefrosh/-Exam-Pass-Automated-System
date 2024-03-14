<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; 
use Carbon\Carbon;  
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function viewlogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate the user input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt user authentication
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication succeeded
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect('/admin-dashboard');
            } elseif ($user->role === 'student') {
                return redirect('/student-dashboard');
            } else {
                return redirect('/login')->with('error', 'Invalid login credentials or account not approved.');
            }
        }

        // Authentication failed, redirect back with an error message.
        return redirect('/login')->with('error', 'Invalid login credentials.');
    }

    public function viewsignup()
    {
        return view('auth.signup');
    }

    public function signup(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'full_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'program' => 'required|string',
            'department' => 'required|string',
            'password' => 'required|min:8',
            'matric_no' => 'required|string|unique:users', 
        ]);

        // Create a new user
        $user = User::create([
            'full_name' => $validatedData['full_name'],
            'email' => $validatedData['email'],
            'program' => $validatedData['program'],
            'department' => $validatedData['department'],
            'password' => bcrypt($validatedData['password']),
            'role' => 'student',
            'matric_no' => $validatedData['matric_no'],
        ]);

        // Send welcome email to the user
        Mail::to($user->email)->send(new WelcomeMail($user->full_name));

        // Redirect after successful signup
        return redirect()->route('viewlogin')->with('success', 'Sign up successful! Please login.');
    }

    public function viewforgetpassword()
    {
        return view('auth.forgetpassword');
    }

    public function ForgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('emails.forgetPassword', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('success', 'We have e-mailed your password reset link!');
    }

    public function showResetPasswordForm($token)
    {
        return view('auth.forgetPasswordLink', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_reset_tokens')
        ->where('email', $request->email)
        ->where('token', $request->token)
        ->first();


            

        if (!$updatePassword) {
            dd($updatePassword);
            
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();

        return redirect('/login')->with('success', 'Your password has been changed!');
    }


    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }


}
