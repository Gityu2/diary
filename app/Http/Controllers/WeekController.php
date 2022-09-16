<?php

namespace App\Http\Controllers;

use App\Models\Week;
use Illuminate\Http\Request;

class WeekController extends Controller
{
    private $week;

    public function __construct(Week $week)
    {
      $this->week = $week;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Week  $week
     * @return \Illuminate\Http\Response
     */
    public function edit($week_id)
    {
      $week = $this->week->findOrFail($week_id);

      return view('diary.weeks.edit', compact('week'));    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Week  $week
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $week_id)
    {
        $week = $this->week->findOrFail($week_id);
  
        $week->fact        = $request->fact;
        $week->discovery   = $request->discovery;
        $week->lesson      = $request->lesson;
        $week->next_action = $request->next_action;
        
        $week->save();
        return redirect()->route('diary.month.show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Week  $week
     * @return \Illuminate\Http\Response
     */
    public function delete($week_id)
    {
      $week = $this->week->findOrFail($week_id);
      
      $week->fact        = null;
      $week->discovery   = null;
      $week->lesson      = null;
      $week->next_action = null;

      $week->save();
      return redirect()->back();

    }
}
