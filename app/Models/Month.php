<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Carbon\CarbonPeriod;

class Month extends Model
{
    use HasFactory;

    public $timestamps = false;

    public static function getDate($day)
    {
        $start_day_of_week = date('D',strtotime(Carbon::create($day)->startOfMonth()));

        if ($start_day_of_week == 'Mon') {
            $month       = Month::where('date', '=', $day->format('Y-m-1'))->first();
            $month_weeks = Week::whereBetween('date', [Carbon::create($day)->startOfMonth(), Carbon::create($day)->endOfMonth()])
                            ->where('user_id', Auth::user()->id)
                            ->get();
    
            $month_days  = Day::whereBetween('date', [Carbon::create($day)->startOfMonth(), Carbon::create($day)->endOfMonth()])
                            ->where('user_id', Auth::user()->id)
                            ->orderBy('date', 'asc')
                            ->get();

        } else {
            $month       = Month::where('date', '=', $day->format('Y-m-1'))->first();
            $month_weeks = Week::whereBetween('date', [Carbon::create($day)->subMonth(1)->endOfMonth(), Carbon::create($day)->endOfMonth()])
                            ->where('user_id', Auth::user()->id)
                            ->get();

            $month_days  = Day::whereBetween('date', [Carbon::create($day)->subMonth(1)->endOfMonth()->startOfWeek(), Carbon::create($day)->endOfMonth()])
                            ->where('user_id', Auth::user()->id)
                            ->orderBy('date', 'asc')
                            ->get();

        };

        return array($month, $month_weeks, $month_days);
    }

    public static function getSearchDate($request)
    {
        $years       = Year::where('user_id', Auth::id())->get();   
        
        $year_info   = $request->year_info;
        $month_info  = $request->month_info;

        if($year_info && $month_info){
            $day   = Day::where('date', '=', date($year_info.'-'. $month_info.'-1'))->where('user_id', '=', Auth::user()->id)->exists();     
            
            if(empty($day)){
            Month::storeMonthDays($year_info, $month_info);        
            }
            $day_info    = Carbon::create($year_info.'-'.$month_info.'-1');

            list($month, $month_weeks, $month_days) = Month::getDate($day_info);

        }else{
            list($month, $month_weeks, $month_days) = Month::getDate(now());
        };

        return array($years, $month, $month_weeks, $month_days);

    }

    public static function storeMonthDays($year_info, $month_info)
    {
        $month_days = CarbonPeriod::create(Carbon::create($year_info.'-'. $month_info.'-1')->startOfMonth(), Carbon::create($year_info.'-'. $month_info.'-1')->endOfMonth());    

        foreach($month_days as $month_day):
            $day = new Day();

            $day->date    = $month_day;
            $day->user_id = Auth::user()->id;
            
            $day->save();
        endforeach;
    }



}
