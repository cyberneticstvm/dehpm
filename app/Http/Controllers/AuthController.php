<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Stevebauman\Location\Facades\Location;

class AuthController extends Controller
{
    function checkLogin()
    {
        if (Auth::user()):
            return redirect()->route('dashboard');
        else:
            return view('login');
        endif;
    }

    function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        try {
            $remember = $request->has('remember');
            if (Auth::attempt($credentials, $remember)):
                $agent = new Agent();
                $location = Location::get($request->ip);
                dd($location);
                die;
            /*createLoginLog($agent, $location);
                return redirect()->intended('dashboard')->with("success", "User logged in successfully");*/
            endif;
            return redirect()->back()->with("error", "The provided credentials do not match with our records.")->withInput($request->all());
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
    }

    function dashboard()
    {
        return view('dashboard');
    }

    function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with("success", "User logged out successfully");
    }

    function forceLogoutGet()
    {
        return view("misc.force-logout");
    }

    function forceLogout(Request $request)
    {
        $credentials = $request->validate([
            'password' => 'required|current-password|min:6',
        ]);
        try {
            Auth::logoutOtherDevices($request->password);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
        return redirect()->route('dashboard')->with("success", "User logged out from all devices successfully!");
    }
}
