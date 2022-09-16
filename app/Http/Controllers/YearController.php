<?php

namespace App\Http\Controllers;

use App\Models\Year;
use App\Models\Month;
use App\Models\Week;
use Illuminate\Http\Request;
use Carbon\CarbonPeriod;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class YearController extends Controller
{
    private $year;
    private $month;
    private $week;

    public function __construct(Year $year, Month $month, Week $week)
    {
        $this->year  = $year;
        $this->month = $month;
        $this->week  = $week;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeYear($year_info)
    {
        $this->year->date    = Carbon::create($year_info . '-1-1');
        $this->year->user_id = Auth::user()->id;

        $this->year->save();
    }

    public function storeYearMonth($year_info)
    {
        $months = CarbonPeriod::create($year_info .'-1-1', $year_info .'-12-31')->month();

        foreach($months as $month_date):
            $month          = new Month();
            $month->date    = $month_date;
            $month->user_id = Auth::user()->id;
            $month->save();
        endforeach;
    }
    
    public function storeYearWeek($year_info)
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Year  $year
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $year_info   = $request->year_info;
        $years       = $this->year->get();

        if ($year_info) {
            $year        = $this->year->where('date', '=', Carbon::create($year_info . '-1-1'))->first();
            $year_months = $this->month->whereBetween('date', [Carbon::create($year_info . '-1-1'), Carbon::create($year_info . '-12-31')])->get();
            $year_weeks  = $this->week->whereBetween('date', [Carbon::create($year_info . '-1-1'), Carbon::create($year_info . '-12-31')])->get();


            // if(empty($year)){
            //     $this->storeYear($year_info);
            // };
            // if(empty($year_months)){
            //     return 1;
            //     $this->storeYearMonth($year_info);
            // };
            // if(empty($year_weeks)){
            //     $this->storeYearWeek($year_info);
            // };


        } else {
            $year        = $this->year->where('date', '=', now()->format('Y-1-1'))->first();
            $year_months = $this->month->whereBetween('date', [Carbon::create(now())->startOfYear(), Carbon::create(now())->endOfYear()])->get();
            $year_weeks  = $this->week->whereBetween('date', [Carbon::create(now())->startOfYear(), Carbon::create(now())->endOfYear()])->get();
        };

        // return $year;

        return view('diary.years.show')
                ->with('years', $years)
                ->with('year', $year)
                ->with('year_months', $year_months)
                ->with('year_weeks', $year_weeks);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Year  $year
     * @return \Illuminate\Http\Response
     */
    public function edit($year_id)
    {
        $year = $this->year->findOrFail($year_id);

        return view('diary.years.edit', compact('year'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Year  $year
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $year_id)
    {
      $year = $this->year->findOrFail($year_id);

      $year->fact        = $request->fact;
      $year->discovery   = $request->discovery;
      $year->lesson      = $request->lesson;
      $year->next_action = $request->next_action;
      
      $year->save();
      return redirect()->route('diary.year.show');    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Year  $year
     * @return \Illuminate\Http\Response
     */
    public function delete($year_id)
    {
      $year = $this->year->findOrFail($year_id);
      
      $year->fact        = null;
      $year->discovery   = null;
      $year->lesson      = null;
      $year->next_action = null;

      $year->save();
      return redirect()->back();

    }
}
