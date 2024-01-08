<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationEmail;


class CustomAuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            if ($user->email_verified_at) {
                if (Auth::attempt($credentials)) {
                    return redirect()->route('dashboard'); // Redirect to the 'dashboard' route
                }
            } else {
                return view('auth.verify_email');
            }
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function registration()
    {
        return view('auth.register');
    }

    public function customRegistration(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
    
        $user = $this->create($request->all());
        
        // Generate a token and send the verification email
        $token = sha1(time());
        $user->verification_token = $token;
        $user->save();
    
        Mail::to($user->email)->send(new VerificationEmail($user));
    
        return redirect()->route('login')->withSuccess('Check your email for verification.');
    }
    
    protected function create(array $data)
    {
        return User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function dashboard()
    {
        if (Auth::check()) {
            return view('auth.dashboard');
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    public function verifyEmail(Request $request, $token)
    {
        $user = User::where('verification_token', $token)->first();

        if ($user) {
            $user->email_verified_at = now();
            $user->verification_token = null; // Assuming you nullify the verification token upon successful verification
            $user->save();

            return redirect()->route('login')->with('success', 'Your email has been verified. You can now login.');
        }

        return redirect()->route('login')->with('error', 'Invalid or expired verification link.');
    }
    
    public function signOut()
    {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
