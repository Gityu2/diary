<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Week;
use App\Models\Month;
use App\Models\Year;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showList(Request $request)
    {   
        $keyword    = $request->keyword;

        list($month_days, $year_weeks, $year_months, $years) = $this->getDate($keyword);

        return view('diary.search.show.list')
                    ->with('years', $years)
                    ->with('year_months', $year_months)
                    ->with('year_weeks', $year_weeks)
                    ->with('month_days', $month_days)
                    ->with('keyword', $keyword);
                            
    }
    
    public function showCard(Request $request)
    {   
        $keyword    = $request->keyword;

        list($month_days, $year_weeks, $year_months, $years) = $this->getDate($keyword);

        return view('diary.search.show.card')
                    ->with('year', $years)
                    ->with('year_months', $year_months)
                    ->with('year_weeks', $year_weeks)
                    ->with('month_days', $month_days)
                    ->with('keyword', $keyword);
                            
    }

    public function getDate($keyword)
    {
        $month_days = Day::orWhere('fact', 'LIKE', "%{$keyword}%")
                            ->orWhere('discovery', 'LIKE', "%{$keyword}%")
                            ->orWhere('lesson', 'LIKE', "%{$keyword}%")
                            ->orWhere('next_action', 'LIKE', "%{$keyword}%")
                            ->orderBy('date')
                            ->get();

        $year_weeks = Week::orWhere('fact', 'LIKE', "%{$keyword}%")
                            ->orWhere('discovery', 'LIKE', "%{$keyword}%")
                            ->orWhere('lesson', 'LIKE', "%{$keyword}%")
                            ->orWhere('next_action', 'LIKE', "%{$keyword}%")
                            ->orderBy('date')
                            ->get();

        $year_months = Month::orWhere('fact', 'LIKE', "%{$keyword}%")
                            ->orWhere('discovery', 'LIKE', "%{$keyword}%")
                            ->orWhere('lesson', 'LIKE', "%{$keyword}%")
                            ->orWhere('next_action', 'LIKE', "%{$keyword}%")
                            ->orderBy('date')
                            ->get();

        $years        = Year::orWhere('fact', 'LIKE', "%{$keyword}%")
                            ->orWhere('discovery', 'LIKE', "%{$keyword}%")
                            ->orWhere('lesson', 'LIKE', "%{$keyword}%")
                            ->orWhere('next_action', 'LIKE', "%{$keyword}%")
                            ->orderBy('date')
                            ->get();

        return array($month_days, $year_weeks, $year_months, $years);
    }

}
