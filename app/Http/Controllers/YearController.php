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
    public function show(Request $request)
    {
        $year_info   = $request->year_info;
        $years       = Year::where('user_id', '=',Auth::user()->id)->get();

        if ($year_info) {
            $year        = Year::where('date', '=', Carbon::create($year_info . '-1-1'))
                                ->where('user_id', '=',Auth::user()->id)
                                ->first();

            $year_months = Month::whereBetween('date', [Carbon::create($year_info . '-1-1'), Carbon::create($year_info . '-12-31')])
                                ->where('user_id', '=',Auth::user()->id)
                                ->get();

            $year_weeks  = Week::whereBetween('date', [Carbon::create($year_info . '-1-1'), Carbon::create($year_info . '-12-31')])
                                ->where('user_id', '=',Auth::user()->id)
                                ->get();

        } else {
            $year        = Year::where('date', '=', now()->format('Y-1-1'))
                                ->where('user_id', '=',Auth::user()->id)
                                ->first();
                                
            $year_months = Month::whereBetween('date', [Carbon::create(now())->startOfYear(), Carbon::create(now())->endOfYear()])
                                ->where('user_id', '=',Auth::user()->id)
                                ->get();

            $year_weeks  = Week::whereBetween('date', [Carbon::create(now())->startOfYear(), Carbon::create(now())->endOfYear()])
                                ->where('user_id', '=',Auth::user()->id)
                                ->get();
        };

        return view('diary.years.show')
                ->with('years', $years)
                ->with('year', $year)
                ->with('year_months', $year_months)
                ->with('year_weeks', $year_weeks);
    }

    public function edit($year_id)
    {
        $year = Year::findOrFail($year_id);

        return view('diary.years.edit', compact('year'));
    }


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
