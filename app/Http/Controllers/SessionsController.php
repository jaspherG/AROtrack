<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\FailedLogin;
use Carbon\Carbon;


class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $email = $credentials['email'];

        if (Auth::attempt($credentials)) {
            FailedLogin::where('email', $email)->delete();
            session()->regenerate();
            return redirect('dashboard')->with(['success'=>'You are logged in.']);
            // return response()->json(['success' => 'Login successful']);
        }

        $failedLogin = FailedLogin::firstOrCreate(['email' => $email]);
        $attempt = $failedLogin->attempts += 1;

        if($failedLogin->attempts == 3) {
            $failedLogin->lockout_time = Carbon::now()->addSeconds(15);
            $failedLogin->disabled_login = 1;
            $failedLogin->save();
            $lockoutTime = Carbon::parse($failedLogin->lockout_time);
            return response()->json([
                'error' => 'Too many login attempts. Please try again later.',
                'lockout_time' => $lockoutTime->timestamp,
            ], 429);
        } else if($failedLogin->attempts == 4) {
            $failedLogin->lockout_time = Carbon::now()->addSeconds(25);
            $failedLogin->disabled_login = 1;
            $failedLogin->save();
            $lockoutTime = Carbon::parse($failedLogin->lockout_time);
            return response()->json([
                'error' => 'Too many login attempts. Please try again later.',
                'lockout_time' => $lockoutTime->timestamp,
            ], 429);
        } else if($failedLogin->attempts == 5) {
            $failedLogin->lockout_time = Carbon::now()->addMinute();
            $failedLogin->disabled_login = 1;
            $failedLogin->save();
            $lockoutTime = Carbon::parse($failedLogin->lockout_time);
            return response()->json([
                'error' => 'Too many login attempts. Please try again later.',
                'lockout_time' => $lockoutTime->timestamp,
            ], 429);
        } else if($failedLogin->attempts >=6) {
            $failedLogin->lockout_time = Carbon::now()->addHour();
            $failedLogin->disabled_login = 1;
            $failedLogin->save();
            $lockoutTime = Carbon::parse($failedLogin->lockout_time);
            return response()->json([
                'error' => 'Too many login attempts. Please try again later.',
                'lockout_time' => $lockoutTime->timestamp,
            ], 429);
        }
        $failedLogin->save();
        $totalAttempts = 3;
        $remainingAttempts = $totalAttempts - $attempt;
        return response()->json(['error' => 'Invalid username or password. You have '.$remainingAttempts.' remaining attempt'], 401);


    }

    private function returnLockTime($failedLogin, $lockTime){
        $failedLogin->lockout_time = $lockTime;
        $failedLogin->disabled_login = 1;
        $failedLogin->save();
        $lockoutTime = Carbon::parse($failedLogin->lockout_time);
        return response()->json([
            'error' => 'Too many login attempts. Please try again later.',
            'lockout_time' => $lockoutTime->timestamp,
        ], 429);
    }

    public function enabledLogin(Request $request){
        $email = $request->input('email');
        $failedLogin = FailedLogin::where('email', $email)->first();

       if ($failedLogin && $failedLogin->disabled_login == 1) {
            $lockoutTime = Carbon::parse($failedLogin->lockout_time);
            if (Carbon::now()->greaterThan($lockoutTime)) {
                $failedLogin->lockout_time = null;
                $failedLogin->disabled_login = 0;
                $failedLogin->save();
            }
        }

        return response()->json(['status' => 'success'], 200);
    }


   

    public function store()
    {
        $attributes = request()->validate([
            'email'=>'required|email',
            'password'=>'required' 
        ]);

        if(Auth::attempt($attributes))
        {
            session()->regenerate();
            return redirect('dashboard')->with(['success'=>'You are logged in.']);
        }
        else{

            return back()->withErrors(['email'=>'Email or password invalid.']);
        }
    }
    

    public function destroy()
    {

        Auth::logout();

        return redirect('/login')->with(['success'=>'You\'ve been logged out.']);
    }
}
