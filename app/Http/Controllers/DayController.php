<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Week;
use App\Models\Month;
use App\Models\Year;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


class DayController extends Controller
{

    const LOCAL_STORAGE_FOLDER = 'public/images/';
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $days   = Day::where('date', '=', date('Y-m-1'))->where('user_id', '=', Auth::user()->id)->exists();     
        $weeks  = Week::where('date', '=', date('Y-1-1'))->where('user_id', '=', Auth::user()->id)->exists();   
        $months = Month::where('date', '=', date('Y-1-1'))->where('user_id', '=', Auth::user()->id)->exists();   
        $year   = Year::where('date', '=', date('Y-1-1'))->where('user_id', '=', Auth::user()->id)->exists();   
        
        if(empty($days)):
            Day::storeMonthDays();
        endif;

        if(empty($weeks)):
            Day::storeYearWeek();
        endif;

        if(empty($months)):
            Day::storeYearMonth();
        endif;

        if(empty($year)):
            Day::storeYear();
        endif;

        return view('diary.days.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'date'  => 'required',
            'image' => 'max:1048|mimes:png,jpg,jpeg,gif'

        ]);
                
        $day = Day::where('date', '=',$request->date)
                        ->where('user_id', '=',Auth::user()->id)
                        ->first();
        
        $day->fact        = $request->fact;
        $day->discovery   = $request->discovery;
        $day->lesson      = $request->lesson;
        $day->next_action = $request->next_action;

        if($request->image){
            if($day->image){
                $this->deleteImage($day->image);
                $day->image = $this->saveImage($request);
            }else{
                $day->image = $this->saveImage($request);
        }};
        
        $day->save();

        return redirect()->route('diary.month.show.list');
    }

    public function saveImage($request)
    {
        $image_name = time() . '.' . $request->image->extension();

        $request->image->storeAs(self::LOCAL_STORAGE_FOLDER, $image_name);
        
        return $image_name;
    }

    public function deleteImage($image_name)
    {
        $image_path = self::LOCAL_STORAGE_FOLDER . $image_name;

        if(Storage::disk('local')->exists($image_path)):
            Storage::disk('local')->delete($image_path);
        endif;
    }

    public function showRegularList()
    {

        $day_1week  = Day::where('date', '=', date('Y-m-d',strtotime(Carbon::create(now())->subWeek(1))))->first();
        $day_2week  = Day::where('date', '=', date('Y-m-d',strtotime(Carbon::create(now())->subWeek(2))))->first();
        $day_3week  = Day::where('date', '=', date('Y-m-d',strtotime(Carbon::create(now())->subWeek(3))))->first();
        $day_1month = Day::where('date', '=', date('Y-m-d',strtotime(Carbon::create(now())->subMonth(1))))->first();
        $day_2month = Day::where('date', '=', date('Y-m-d',strtotime(Carbon::create(now())->subMonth(2))))->first();
        $day_3month = Day::where('date', '=', date('Y-m-d',strtotime(Carbon::create(now())->subMonth(3))))->first();
        $day_6month = Day::where('date', '=', date('Y-m-d',strtotime(Carbon::create(now())->subMonth(6))))->first();
        $day_1year  = Day::where('date', '=', date('Y-m-d',strtotime(Carbon::create(now())->subYear(1))))->first();

        $days = collect(
                [
                '1 week'  => $day_1week, 
                '2 week'  => $day_2week, 
                '3 week'  => $day_3week, 
                '1 month' => $day_1month, 
                '2 month' => $day_2month, 
                '3 month' => $day_3month, 
                '6 month' => $day_6month,
                '1 year'  => null
                ]);
        
        if($day_1year){
            $days = $days->merge(['1 year' => $day_1year]);
        };

        return view('diary.regular.show.list')
                ->with('days', $days);
    }

    public function showRegularCard()
    {
        $day_1week  = Day::where('date', '=', date('Y-m-d',strtotime(Carbon::create(now())->subWeek(1))))->first();
        $day_2week  = Day::where('date', '=', date('Y-m-d',strtotime(Carbon::create(now())->subWeek(2))))->first();
        $day_3week  = Day::where('date', '=', date('Y-m-d',strtotime(Carbon::create(now())->subWeek(3))))->first();
        $day_1month = Day::where('date', '=', date('Y-m-d',strtotime(Carbon::create(now())->subMonth(1))))->first();
        $day_2month = Day::where('date', '=', date('Y-m-d',strtotime(Carbon::create(now())->subMonth(2))))->first();
        $day_3month = Day::where('date', '=', date('Y-m-d',strtotime(Carbon::create(now())->subMonth(3))))->first();
        $day_6month = Day::where('date', '=', date('Y-m-d',strtotime(Carbon::create(now())->subMonth(6))))->first();
        $day_1year  = Day::where('date', '=', date('Y-m-d',strtotime(Carbon::create(now())->subYear(1))))->first();

        $days = collect([
                '1 week'  => $day_1week, 
                '2 week'  => $day_2week, 
                '3 week'  => $day_3week, 
                '1 month' => $day_1month, 
                '2 month' => $day_2month, 
                '3 month' => $day_3month, 
                '6 month' => $day_6month
                ]);
        
        if($day_1year){
            $days = $days->merge(['1 year' => $day_1year]);
        };

        return view('diary.regular.show.card')
                ->with('days', $days);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Day  $day
     * @return \Illuminate\Http\Response
     */
    public function edit($day_id)
    {
        $day = Day::findOrFail($day_id);

        return view('diary.days.edit')->with('day', $day);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Day  $day
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $day_id)
    {
        $day = Day::findOrFail($day_id);
        $url = $request->url;
        // $urls = str_replace('http://127.0.0.1:8000/', '', $url);

        $request->validate([
            'image' => 'max:1048|mimes:png,jpg,jpeg,gif'
        ]);

        $day->fact        = $request->fact;
        $day->discovery   = $request->discovery;
        $day->lesson      = $request->lesson;
        $day->next_action = $request->next_action;

        if($request->image){
            if($day->image){
                $this->deleteImage($day->image);
                $day->image = $this->saveImage($request);
            }else{
                $day->image = $this->saveImage($request);
            }
        };
        
        $day->save();
        return redirect($url);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Day  $day
     * @return \Illuminate\Http\Response
     */
    public function reset($day_id)
    {
        $day = Day::findOrFail($day_id);

        $this->deleteImage($day->image);
        
        $day->fact        = null;
        $day->discovery   = null;
        $day->lesson      = null;
        $day->next_action = null;
        $day->image       = null;

        $day->save();

        return redirect()->back();
    }

    // public function destroy($user_id)
    // {
    //     Day::where('user_id', $user_id)->delete();
    //     Week::where('user_id', $user_id)->delete();
    //     Month::where('user_id', $user_id)->delete();
    //     Year::where('user_id', $user_id)->delete();
    //     User::where('id', $user_id)->delete();

    //     return redirect('/');
    // }
}
