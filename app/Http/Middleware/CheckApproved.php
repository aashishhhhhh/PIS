<?php

namespace App\Http\Middleware;

use App\Models\PisModel\Staff;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class CheckApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $user = auth()->user();
        $staff = Staff::query()->where('user_id', $user->id)->first();
        if ($staff != null) {
            if ($staff->is_approved == 1) {
                return redirect()->back()->with('msg', 'स्वीकृत भैसक्यो');
            }
        }

        if ($user->is_verified == 0) {
            return redirect()->back()->with('msg', 'स्वीकृत हुन् वाकी');
        }
        if ($user->is_verified == 2) {
            return redirect()->back()->with('msg', 'तपाइको दर्ता अनुरोध अस्वीकृत गरिएको छ');
        }


        return $next($request);
    }
}
