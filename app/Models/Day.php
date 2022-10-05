<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DayLike;
use App\Models\Week;
use App\Models\Month;
use App\Models\Year;
use Carbon\CarbonPeriod;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class Day extends Model
{
    use HasFactory;

    public $timestamps = false;

    //Relation
    public function like()
    {
        return $this->hasOne(DayLike::class);
    }


    //Function
    public static function storeMonthDays()
    {
        $month_days = CarbonPeriod::create(Carbon::create(now())->startOfYear(), Carbon::create(now())->endOfYear());    

        foreach($month_days as $month_day):
            $day          = new Day();
            $day->date    = $month_day;
            $day->user_id = Auth::user()->id;
            $day->save();
        endforeach;
    }

    public static function storeYearWeek() 
    {
        $year_weeks = CarbonPeriod::create(Carbon::create(now())->startOfYear(), Carbon::create(now())->endOfYear())->week();

        $num = 1;
        
        foreach($year_weeks as $year_week):
            $week          = new Week();
            $week->week    = $num ++;   //or date('W',2022-1-1);
            $week->date    = $year_week;
            $week->user_id = Auth::user()->id;
            $week->save();
        endforeach;
    }

    public static function storeYearMonth() 
    {
        $year_months = CarbonPeriod::create(Carbon::create(now())->startOfYear(), Carbon::create(now())->endOfYear())->month();

        foreach($year_months as $year_month):
            $month          = new Month();
            $month->date    = $year_month;
            $month->user_id = Auth::user()->id;
            $month->save();
        endforeach;

    }

    public static function storeYear() 
    {
        $year = new Year;

        $year->date    = Carbon::create(now())->startOfYear();
        $year->user_id = Auth::user()->id;

        $year->save();
    }

    public static function storeYearLast() 
    {
        $year_last = new Year;

        $year_last->date    = Carbon::create(now())->subYear(1)->startOfYear();
        $year_last->user_id = Auth::user()->id;
        
        $year_last->save();

    }


}
