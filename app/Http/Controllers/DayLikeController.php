<?php

namespace App\Http\Controllers;

use App\Models\DayLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DayLikeController extends Controller
{
    private $like;

    public function __construct(DayLike $like)
    {
        $this->like = $like;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($day_id)
    {
        $this->like->user_id = Auth::user()->id;
        $this->like->day_id  = $day_id;

        // return $this->like;
        $this->like->save();
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
        $likes = $this->like->join('days', 'day_likes.day_id', 'days.id')
                            ->where('day_likes.user_id', Auth::user()->id)
                            ->orderBy('date')
                            ->get();

        return view('diary.favorites.show.list')->with('likes', $likes);
    
    }

    public function showCard()
    {
        $likes = $this->like->join('days', 'day_likes.day_id', 'days.id')
                            ->where('day_likes.user_id', Auth::user()->id)
                            ->orderBy('date')
                            ->get();
        
        return view('diary.favorites.show.card')->with('likes', $likes);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DayLike  $dayLike
     * @return \Illuminate\Http\Response
     */
    public function destroy($day_id)
    {
        $this->like->destroy($day_id);

        return redirect()->back();
    }
}
