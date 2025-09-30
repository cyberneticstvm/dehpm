<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\LoginLog;
use App\Models\User;
use App\Models\UserBranch;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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
                $user = User::find(Auth::user()->id);
                $devices = $user->devices()->pluck('name');
                print_r($user);
                die;
            /*if (in_array(loggedDevice($agent), $devices)):
                    createLoginLog($agent, $location);
                    return redirect()->intended('dashboard')->with("success", "User logged in successfully");
                else:
                    return redirect()->route('logout')->with("error", "User not allowed to login inti this device");
                endif;*/
            endif;
            return redirect()->back()->with("error", "The provided credentials do not match with our records.")->withInput($request->all());
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
    }

    function loginLog()
    {
        $logs = LoginLog::orderByDesc('id')->get();
        return view('misc.login-log', compact('logs'));
    }

    function updateBranch(Request $request)
    {
        $branch = Branch::findOrFail($request->branch);
        Session::put('branch', $branch);
        if (Session::has('branch')) :
            return redirect()->route('dashboard')
                ->withSuccess('User branch updated successfully!');
        else :
            return redirect()->route('dashboard')
                ->withError('Please update branch!');
        endif;
    }

    function dashboard()
    {
        $branches = Branch::whereIn('id', UserBranch::where('user_id', Auth::id())->pluck('branch_id'))->pluck('name', 'id');
        return view('dashboard', compact('branches'));
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
