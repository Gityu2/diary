<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Carbon\CarbonPeriod;

class Year extends Model
{
    use HasFactory;

    public $timestamps = false;

    public static function storeYear($year_info)
    {
        $year = new Year;

        $year->date    = Carbon::create($year_info . '-1-1');
        $year->user_id = Auth::user()->id;

        $year->save();
    }

    public static function storeYearMonth($year_info)
    {
        $months = CarbonPeriod::create($year_info .'-1-1', $year_info .'-12-31')->month();

        foreach($months as $month_date):
            $month          = new Month();
            $month->date    = $month_date;
            $month->user_id = Auth::user()->id;
            $month->save();
        endforeach;
    }
    
    public static function storeYearWeek($year_info)
    {
        $weeks = CarbonPeriod::create($year_info . '-1-1', $year_info . '-12-31')->week();

        $num = 1;
        
        foreach($weeks as $week_date):
            $week          = new Week();
            $week->week    = $num ++;
            $week->date    = $week_date;
            $week->user_id = Auth::user()->id;
            $week->save();
        endforeach;

    }


}
