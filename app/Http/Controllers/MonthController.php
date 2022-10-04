<?php

namespace App\Http\Controllers;

use App\Models\Year;
use App\Models\Month;
use App\Models\Week;
use App\Models\Day;
use Illuminate\Http\Request;
use Carbon\CarbonPeriod;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class MonthController extends Controller
{
  private $year;
  private $month;
  private $week;
  private $day;


  public function __construct(Year $year, Month $month, Week $week,Day $day)
  {
    $this->year  = $year;
    $this->month = $month;
    $this->week  = $week;
    $this->day   = $day;

  }

    public function indexCard() //nesessary??
    {
      $month       = $this->month->where('date', '=', now()->format('Y-m-1'))->first();
      $month_weeks = $this->week->whereBetween('date', [Carbon::create(now())->startOfMonth(), Carbon::create(now())->endOfMonth()])->get();
      $month_days  = $this->day->whereBetween('date', [Carbon::create(now())->startOfMonth(), Carbon::create(now())->endOfMonth()])->get();

      $week_days = $this->day->whereBetween('date', [Carbon::create(now())->startOfWeek(), Carbon::create(now())->endOfWeek()])->get();
      // return $week_days;
      

      return view('month_card')
                ->with('month', $month)
                ->with('month_weeks', $month_weeks)
                ->with('month_days', $month_days);
    }

    public function getDate($month, $month_weeks, $month_days, $day)
    {
        $start_day_of_week = date('D',strtotime(Carbon::create($day)->startOfMonth()));

        if ($start_day_of_week == 'Mon') {
            $month       = $this->month->where('date', '=', $day->format('Y-m-1'))->first();
            $month_weeks = $this->week
                            ->whereBetween('date', [Carbon::create($day)->startOfMonth(), Carbon::create($day)->endOfMonth()])
                            ->where('user_id', Auth::user()->id)
                            ->get();
    
            $month_days  = $this->day
                            ->whereBetween('date', [Carbon::create($day)->startOfMonth(), Carbon::create($day)->endOfMonth()])
                            ->where('user_id', Auth::user()->id)
                            ->orderBy('date', 'asc')
                            ->get();

        } else {
            $month       = $this->month->where('date', '=', $day->format('Y-m-1'))->first();
            $month_weeks = $this->week
                            ->whereBetween('date', [Carbon::create($day)->subMonth(1)->endOfMonth(), Carbon::create($day)->endOfMonth()])
                            ->where('user_id', Auth::user()->id)
                            ->get();

            $month_days  = $this->day
                            ->whereBetween('date', [Carbon::create($day)->subMonth(1)->endOfMonth()->startOfWeek(), Carbon::create($day)->endOfMonth()])
                            ->where('user_id', Auth::user()->id)
                            ->orderBy('date', 'asc')
                            ->get();

        };

        return [$month, $month_weeks, $month_days];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Month  $month
     * @return \Illuminate\Http\Response
     */
    public function showList(Request $request)  
    {
      $year_info   = $request->year_info;
      $month_info  = $request->month_info;

      $years       = $this->year->get();
      $month       = null;
      $month_weeks = null;
      $month_days  = null;

      $all_data    = $this->getDate($month, $month_weeks, $month_days, now());

      $month       = $all_data[0];
      $month_weeks = $all_data[1];
      $month_days  = $all_data[2];

      if($year_info && $month_info){
        
        $day   = $this->day->where('date', '=', date($year_info.'-'. $month_info.'-1'))->where('user_id', '=', Auth::user()->id)->exists();     
        
        if(empty($day)){
          $this->storeMonthDays($year_info, $month_info);        
        }
        $day_info    = Carbon::create($year_info.'-'.$month_info.'-1');

        $all_data    = $this->getDate($month, $month_weeks, $month_days, $day_info);

        $month       = $all_data[0];
        $month_weeks = $all_data[1];
        $month_days  = $all_data[2];

          
      };
      

      return view('diary.months.show.list')
                ->with('years', $years)
                ->with('month', $month)
                ->with('month_weeks', $month_weeks)
                ->with('month_days', $month_days);
    }

    public function showCard(Request $request)  
    {
      $year_info   = $request->year_info;
      $month_info  = $request->month_info;

      $years       = $this->year->get();
      $month       = null;
      $month_weeks = null;
      $month_days  = null;

      $all_data    = $this->getDate($month, $month_weeks, $month_days, now());

      $month       = $all_data[0];
      $month_weeks = $all_data[1];
      $month_days  = $all_data[2];

      if($year_info && $month_info){
        
        $day   = $this->day->where('date', '=', date($year_info.'-'. $month_info.'-1'))->where('user_id', '=', Auth::user()->id)->exists();     
        
        if(empty($day)){
          $this->storeMonthDays($year_info, $month_info);        
        }
        $day_info    = Carbon::create($year_info.'-'.$month_info.'-1');

        $all_data    = $this->getDate($month, $month_weeks, $month_days, $day_info);

        $month       = $all_data[0];
        $month_weeks = $all_data[1];
        $month_days  = $all_data[2];
      };
      

      return view('diary.months.show.card')
                ->with('years', $years)
                ->with('month', $month)
                ->with('month_weeks', $month_weeks)
                ->with('month_days', $month_days);
    }

    public function storeMonthDays($year_info, $month_info)
    {
      $month_days = CarbonPeriod::create(Carbon::create($year_info.'-'. $month_info.'-1')->startOfMonth(), Carbon::create($year_info.'-'. $month_info.'-1')->endOfMonth());    

      foreach($month_days as $month_day):
        $day = new Day();
        $day->date = $month_day;
        $day->user_id = Auth::user()->id;
        $day->save();
      endforeach;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Month  $month
     * @return \Illuminate\Http\Response
     */
    public function edit($month_id)
    {
      $month = $this->month->findOrFail($month_id);

      return view('diary.months.edit', compact('month'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Month  $month
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $month_id)
    {
      $month = $this->month->findOrFail($month_id);

      $url = $request->url;
      $month->fact        = $request->fact;
      $month->discovery   = $request->discovery;
      $month->lesson      = $request->lesson;
      $month->next_action = $request->next_action;
      
      $month->save();
      return redirect($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Month  $month
     * @return \Illuminate\Http\Response
     */
    public function delete($month_id)
    {
      $month = $this->month->findOrFail($month_id);
      
      $month->fact        = null;
      $month->discovery   = null;
      $month->lesson      = null;
      $month->next_action = null;

      $month->save();
      return redirect()->back();

    }
}
