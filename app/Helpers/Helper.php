<?php

/*function uniqueRegistrationId()
{
    do {
        $code = random_int(1000000, 9999999);
    } while (Ad::where("registration_id", $code)->first());

    return $code;
}*/

use App\Models\LoginLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

function createLoginLog($agent, $location)
{
    $devices = ['Computer', 'Android', 'iOS', 'Tablet', 'Other'];
    $device = $devices[0];
    $uid = Str::uuid();
    if ($agent->isMobile() && $agent->isAndroidOS()) {
        $device = $devices[1];
    } elseif ($agent->isTablet()) {
        $device = $devices[2];
    } elseif ($agent->isMobile() && $agent->isSafari()) {
        $device = $devices[3];
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
        'login_at' => Carbon::now(),
    ]);
    User::where('id', Auth::user()->id)->update([
        'login_session_id' => $uid,
    ]);
}
