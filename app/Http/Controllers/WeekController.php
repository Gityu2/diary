<?php

namespace App\Http\Controllers;

use App\Models\Week;
use Illuminate\Http\Request;

class WeekController extends Controller
{
    public function edit($week_id)
    {
        $week = Week::findOrFail($week_id);

        return view('diary.weeks.edit', compact('week'));    }


    public function update(Request $request, $week_id)
    {
        $url = $request->url;
        
        $week = Week::findOrFail($week_id);

        $week->fact        = $request->fact;
        $week->discovery   = $request->discovery;
        $week->lesson      = $request->lesson;
        $week->next_action = $request->next_action;
        
        $week->save();

        return redirect($url);
    }

    public function reset($week_id)
    {
        $week = Week::findOrFail($week_id);
        
        $week->fact        = null;
        $week->discovery   = null;
        $week->lesson      = null;
        $week->next_action = null;

        $week->save();
        return redirect()->back();

    }
}
