<?php

namespace App\Http\Controllers;

use App\Models\LoginLog;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Str;

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
                $device = "Computer";
                $uid = Str::uuid();
                if ($agent->isMobile() && $agent->isAndroidOS()) {
                    $device = "Android";
                } elseif ($agent->isTablet()) {
                    $device = "Tablet";
                } elseif ($agent->isMobile() && $agent->isSafari()) {
                    $device = "iOS";
                }
                LoginLog::create([
                    'user_id' => Auth::user()->id,
                    'ip_address' => $location->ip,
                    'user_agent' => $device,
                    'country' => $location->countryName,
                    'region' => $location->regionName,
                    'city' => $location->cityName,
                    'zip' => $location->zipCode,
                    'lat' => $location->latitude,
                    'lng' => $location->longitude,
                    'login_session_id' => $uid,
                ]);
                User::where('id', Auth::user()->id)->update([
                    'login_session_id' => $uid,
                ]);
                return redirect()->intended('dashboard')->with("success", "User logged in successfully");
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
        LoginLog::where('user_id', Auth::user()->id)->where('login_session_id', Auth::user()->login_session_id)->update([
            'logout_at' => Carbon::now(),
        ]);
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
