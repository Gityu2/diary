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

    public static function getRegularDate()
    {
        $day_1week  = Day::where('date', '=', date('Y-m-d',strtotime(Carbon::create(now())->subWeek(1))))->first();
        $day_2week  = Day::where('date', '=', date('Y-m-d',strtotime(Carbon::create(now())->subWeek(2))))->first();
        $day_3week  = Day::where('date', '=', date('Y-m-d',strtotime(Carbon::create(now())->subWeek(3))))->first();
        $day_1month = Day::where('date', '=', date('Y-m-d',strtotime(Carbon::create(now())->subMonth(1))))->first();
        $day_2month = Day::where('date', '=', date('Y-m-d',strtotime(Carbon::create(now())->subMonth(2))))->first();
        $day_3month = Day::where('date', '=', date('Y-m-d',strtotime(Carbon::create(now())->subMonth(3))))->first();
        $day_6month = Day::where('date', '=', date('Y-m-d',strtotime(Carbon::create(now())->subMonth(6))))->first();
        $day_1year  = Day::where('date', '=', date('Y-m-d',strtotime(Carbon::create(now())->subYear(1))))->first();

        $days = collect(
                [
                '1 week'  => $day_1week, 
                '2 week'  => $day_2week, 
                '3 week'  => $day_3week, 
                '1 month' => $day_1month, 
                '2 month' => $day_2month, 
                '3 month' => $day_3month, 
                '6 month' => $day_6month,
                '1 year'  => $day_1year
                ]);

        return $days;
    }


}
