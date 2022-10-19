<?php

namespace App\Http\Controllers;

use App\Models\DayLike;
use App\Models\Day;
use Illuminate\Support\Facades\Auth;

class DayLikeController extends Controller
{

    public function store($day_id)
    {
        $like = new DayLike;
        $like->user_id = Auth::user()->id;
        $like->day_id  = $day_id;

        $like->save();
        return redirect()->back();
    }


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

    public function destroy($day_id)
    {
        DayLike::destroy($day_id);
        return redirect()->back();
    }
}
