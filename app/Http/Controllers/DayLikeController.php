<?php

namespace App\Http\Controllers;

use App\Models\DayLike;
use App\Models\Day;
use Illuminate\Support\Facades\Auth;

class DayLikeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($day_id)
    {
        $like = new DayLike;
        $like->user_id = Auth::user()->id;
        $like->day_id  = $day_id;

        $like->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DayLike  $dayLike
     * @return \Illuminate\Http\Response
     */
    public function showList()
    {
        $month_days = Day::whereHas('like', function($query){
                            $query->where('user_id', Auth::user()->id);
                            })
                            ->orderBy('date')
                            ->get();

        return view('diary.favorites.show.list')->with('month_days', $month_days);
    
    }

    public function showCard()
    {
        $month_days = Day::whereHas('like', function($query){
            $query->where('user_id', Auth::user()->id);
            })
            ->orderBy('date')
            ->get();
        
        return view('diary.favorites.show.card')->with('month_days', $month_days);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DayLike  $dayLike
     * @return \Illuminate\Http\Response
     */
    public function destroy($day_id)
    {
        DayLike::destroy($day_id);
        return redirect()->back();
    }
}
