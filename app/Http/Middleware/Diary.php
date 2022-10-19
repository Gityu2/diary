<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Day;
use App\Models\Week;
use App\Models\Month;
use App\Models\Year;
use Illuminate\Support\Facades\Auth;

class Diary
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
        $days   = Day::where('date', '=', date('Y-m-1'))->where('user_id', '=', Auth::user()->id)->exists();     
        $weeks  = Week::where('date', '=', date('Y-1-1'))->where('user_id', '=', Auth::user()->id)->exists();   
        $months = Month::where('date', '=', date('Y-1-1'))->where('user_id', '=', Auth::user()->id)->exists();   
        $year   = Year::where('date', '=', date('Y-1-1'))->where('user_id', '=', Auth::user()->id)->exists();   
        
        if(empty($days)):
            Day::storeMonthDays();
        endif;

        if(empty($weeks)):
            Day::storeYearWeek();
        endif;

        if(empty($months)):
            Day::storeYearMonth();
        endif;

        if(empty($year)):
            Day::storeYear();
        endif;
        return $next($request);
    }
}
