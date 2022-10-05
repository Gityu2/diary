<?php

namespace App\Http\Controllers;

use App\Models\Month;
use App\Models\Day;
use Illuminate\Http\Request;
use Carbon\CarbonPeriod;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class MonthController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Month  $month
     * @return \Illuminate\Http\Response
     */
    public function showList(Request $request)  
    {
        list($years, $month, $month_weeks, $month_days) = Month::getSearchDate($request);

        return view('diary.months.show.list')
                    ->with('years', $years)
                    ->with('month', $month)
                    ->with('month_weeks', $month_weeks)
                    ->with('month_days', $month_days);
    }

    public function showCard(Request $request)  
    {
        list($years, $month, $month_weeks, $month_days) = Month::getSearchDate($request);

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

            $day->date    = $month_day;
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
        $month = Month::findOrFail($month_id);

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
        $url   = $request->url;
        $month = Month::findOrFail($month_id);

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
    public function reset($month_id)
    {
        $month = Month::findOrFail($month_id);
        
        $month->fact        = null;
        $month->discovery   = null;
        $month->lesson      = null;
        $month->next_action = null;

        $month->save();
        
        return redirect()->back();
    }
}
