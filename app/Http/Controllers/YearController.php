<?php

namespace App\Http\Controllers;

use App\Models\Year;
use App\Models\Month;
use App\Models\Week;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class YearController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Year  $year
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $year_info   = $request->year_info;
        $years       = Year::get();

        if ($year_info) {
            $year        = Year::where('user_id', Auth::id())->where('date', '=', Carbon::create($year_info . '-1-1'))->first();
            $year_months = Month::where('user_id', Auth::id())->whereBetween('date', [Carbon::create($year_info . '-1-1'), Carbon::create($year_info . '-12-31')])->get();
            $year_weeks  = Week::where('user_id', Auth::id())->whereBetween('date', [Carbon::create($year_info . '-1-1'), Carbon::create($year_info . '-12-31')])->get();

        } else {
            $year        = Year::where('user_id', Auth::id())->where('date', '=', now()->format('Y-1-1'))->first();
            $year_months = Month::where('user_id', Auth::id())->whereBetween('date', [Carbon::create(now())->startOfYear(), Carbon::create(now())->endOfYear()])->get();
            $year_weeks  = Week::where('user_id', Auth::id())->whereBetween('date', [Carbon::create(now())->startOfYear(), Carbon::create(now())->endOfYear()])->get();
        };

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
        $year = Year::findOrFail($year_id);

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
        $url  = $request->url;
        $year = Year::findOrFail($year_id);

        $year->fact        = $request->fact;
        $year->discovery   = $request->discovery;
        $year->lesson      = $request->lesson;
        $year->next_action = $request->next_action;
        
        $year->save();
        return redirect($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Year  $year
     * @return \Illuminate\Http\Response
     */
    public function reset($year_id)
    {
        $year = Year::findOrFail($year_id);
        
        $year->fact        = null;
        $year->discovery   = null;
        $year->lesson      = null;
        $year->next_action = null;

        $year->save();
        return redirect()->back();
    }
}
