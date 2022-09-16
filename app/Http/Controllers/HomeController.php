<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\CarbonPeriod;
use Carbon\Carbon;
use App\Models\Day;



class HomeController extends Controller
{

    private $day;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Day $day)
    {
        $this->middleware('auth');
        $this->day = $day;

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        #Days
        $x = 2022;
        $year = CarbonPeriod::create(date($x.'-1-1'), date($x.'-12-31'));

        $now = Carbon::create(now());
        $month_days = CarbonPeriod::create(now()->startOfMonth(), now()->endOfMonth());
        $month_weeks = CarbonPeriod::create(now()->startOfMonth(), now()->endOfMonth())->weeks();
        // $week_days = CarbonPeriod::create(now()->startOfWeek(), now()->endOfWeek());
        $week_days = $this->day->whereBetween('date', [Carbon::create(now())->startOfWeek(), Carbon::create(now())->endOfWeek()])->get();
        // $weeks = $this->day->where('date', Carbon::create('yesterday'))->get();
        $weeks = $this->day
                    ->where  ('date', '=', Carbon::create('today')->subWeek(1))
                    ->orWhere('date', '=', Carbon::create('today')->subWeek(2))
                    ->orWhere('date', '=', Carbon::create('today')->subWeek(3))
                    ->orWhere('date', '=', Carbon::create('today')->subMonth(1))
                    ->orWhere('date', '=', Carbon::create('today')->subMonth(2))
                    ->orWhere('date', '=', Carbon::create('today')->subMonth(3))
                    ->orWhere('date', '=', Carbon::create('today')->subMonth(6))
                    ->orWhere('date', '=', Carbon::create('today')->subYear(1))
                    ->get();

        // return $week_days;
        // foreach($year as $date):
        //     echo $date->format('Y-m-d-D');
        //     // echo $date->format('W');
        //     echo "<br>";
        //   endforeach;
        
        
          
        #Contens of diary

        // $day = $this->day->where('date', '=', date(2022))->get();


        return view('home')
                ->with('now',$now)
                ->with('month_days',$month_days)
                ->with('month_weeks',$month_weeks)
                ->with('weeks',$weeks)
                ->with('week_days',$week_days);
                // ->with('days', $days);
    }


}
