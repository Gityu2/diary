<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\DayLike;
use App\Models\Week;
use App\Models\Month;
use App\Models\Year;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\CarbonPeriod;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Session\Session;


class DayController extends Controller
{

    private $day;
    private $week;
    private $month;
    private $year;
    private $like;

    const LOCAL_STORAGE_FOLDER = 'public/images/';
    

    public function __construct(Day $day, Week $week, Month $month, Year $year, DayLike $like)
    {
        $this->day = $day;
        $this->week = $week;
        $this->month = $month;
        $this->year = $year;
        $this->like = $like;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAllList(Request $request) // Supposed to delete
    {   
      $keyword    = $request->keyword;
      $period     = $request->period;
      $year_info  = $request->year_info;
      $month_info = $request->month_info;

      if($keyword) {
          $month_days = $this->day
                    ->orWhere('fact', 'LIKE', "%{$keyword}%")
                    ->orWhere('discovery', 'LIKE', "%{$keyword}%")
                    ->orWhere('lesson', 'LIKE', "%{$keyword}%")
                    ->orWhere('next_action', 'LIKE', "%{$keyword}%")
                    ->orderBy('date')
                    ->get();
                    // return $days;
                    
          $year_weeks = $this->week
                    ->orWhere('fact', 'LIKE', "%{$keyword}%")
                    ->orWhere('discovery', 'LIKE', "%{$keyword}%")
                    ->orWhere('lesson', 'LIKE', "%{$keyword}%")
                    ->orWhere('next_action', 'LIKE', "%{$keyword}%")
                    ->orderBy('date')
                    ->get();
                    
          $year_months = $this->month
                    ->orWhere('fact', 'LIKE', "%{$keyword}%")
                    ->orWhere('discovery', 'LIKE', "%{$keyword}%")
                    ->orWhere('lesson', 'LIKE', "%{$keyword}%")
                    ->orWhere('next_action', 'LIKE', "%{$keyword}%")
                    ->orderBy('date')
                    ->get();

          $year = $this->year
                    ->orWhere('fact', 'LIKE', "%{$keyword}%")
                    ->orWhere('discovery', 'LIKE', "%{$keyword}%")
                    ->orWhere('lesson', 'LIKE', "%{$keyword}%")
                    ->orWhere('next_action', 'LIKE', "%{$keyword}%")
                    ->orderBy('date')
                    ->get();
          // return $year;

              // $month       = $this->month->where('date', '=', now()->format('Y-m-1'))->first();
              // $month_weeks = $this->week->whereBetween('date', [Carbon::create(now())->startOfMonth(), Carbon::create(now())->endOfMonth()])->get();
              // $month_days  = $this->day->whereBetween('date', [Carbon::create(now())->startOfMonth(), Carbon::create(now())->endOfMonth()])->get();

              // $year        = $this->year->where('date', '=', now()->format('Y-1-1'))->first();
              // $year_months = $this->month->whereBetween('date', [Carbon::create(now())->startOfYear(), Carbon::create(now())->endOfYear()])->get();
              // $year_weeks  = $this->week->whereBetween('date', [Carbon::create(now())->startOfYear(), Carbon::create(now())->endOfYear()])->get();
              return view('diary.all.show.list')
                        ->with('year', $year)
                        ->with('year_months', $year_months)
                        ->with('year_weeks', $year_weeks)
                        ->with('month_days', $month_days)
                        ->with('keyword', $keyword);
                        
      }elseif($period == "month") {
        
        $year = 0;
        $month = $this->month->where('date', '=', ( $year_info.'-'. $month_info.'-1'))->first();
        $month_weeks  = $this->week->whereBetween('date', [Carbon::create(( $year_info.'-'. $month_info.'-1'))->startOfMonth(), Carbon::create(( $year_info.'-'. $month_info.'-1'))->endOfMonth()])->get();
        $month_days  = $this->day->whereBetween('date', [Carbon::create(( $year_info.'-'. $month_info.'-1'))->startOfMonth(), Carbon::create(( $year_info.'-'. $month_info.'-1'))->endOfMonth()])->get();
      
        return view('diary.all.show.list')
          ->with('year', $year)
          ->with('month', $month)
          ->with('month_weeks', $month_weeks)
          ->with('month_days', $month_days)
          ->with('keyword', $keyword);
    
      }elseif($period == "year"){
        
        $year = $this->year->where('date', '=', ( $year_info.'-1-1'))->first();
        $year_months  = $this->month->whereBetween('date', [Carbon::create(( $year_info.'-1-1'))->startOfYear(), Carbon::create(( $year_info.'-1-1'))->endOfYear()])->get();
        $year_weeks  = $this->week->whereBetween('date', [Carbon::create(( $year_info. '-1-1'))->startOfYear(), Carbon::create(( $year_info.'-1-1'))->endOfYear()])->get();
        $month_days        = 0;

      }else{
        $year = 0;
        $year_months = 0;
        $year_weeks =0;
        $month_days = 0;
      };
      return view('diary.all.show.list', compact('year','year_months','year_weeks','month_days','keyword'));


      // }elseif($keyword){
      //   $days = $this->day
      //   ->where('fact', 'LIKE', "%{$keyword}%")
      //   ->get();

      // }elseif($key){
      //   $days = $this->day
      //   ->where('discovery', 'LIKE', "%{$key}%")
      //   ->get();

      // }elseif($date == 'yesterday'){

      //   $days = $this->day->whereBetween('date', [Carbon::create(now())->startOfMonth(), Carbon::create(now())->endOfMonth()])->get();
      
      // }elseif($period == 'week'){

      //   $days = $this->week->whereBetween('date', [Carbon::create(now())->startOfMonth(), Carbon::create(now())->endOfMonth()])->get();

      // }else{
      //   $days = 0;
      // }

      // $month_days  = $this->day->whereBetween('date', [Carbon::create(now())->startOfMonth(), Carbon::create(now())->endOfMonth()])->get();
      
      // return view('viewl_all', compact('keyword'));
    }

    public function showAllCard(Request $request) // Supposed to delete
    {
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $days        = $this->day->where('date', '=', date('Y-m-1'))->where('user_id', '=', Auth::user()->id)->exists();     
        $weeks       = $this->week->where('date', '=', date('Y-1-1'))->where('user_id', '=', Auth::user()->id)->exists();   
        $months      = $this->month->where('date', '=', date('Y-1-1'))->where('user_id', '=', Auth::user()->id)->exists();   
        $year        = $this->year->where('date', '=', date('Y-1-1'))->where('user_id', '=', Auth::user()->id)->exists();   
        // $year_last   = Year::where('date', '=', Carbon::create(now()->subYear(1)->startOfYear()))->where('user_id', '=', Auth::user()->id)->exists();   
        // return $year_last;
        
        if(empty($days)):
            $this->storeMonthDays();
        endif;

        if(empty($weeks)):
            $this->storeYearWeek();
        endif;

        if(empty($months)):
            $this->storeYearMonth();
        endif;

        if(empty($year)):
            $this->storeYear();
        endif;

        // if(empty($year_last)):
        //     $this->storeYearLast();
        // endif;

        return view('diary.days.create');
    }

    public function storeMonthDays()//necessary??
    {
        $month_days = CarbonPeriod::create(Carbon::create(now())->startOfYear(), Carbon::create(now())->endOfYear());    

        foreach($month_days as $month_day):
            $day = new Day();
            $day->date = $month_day;
            $day->user_id = Auth::user()->id;
            $day->save();
        endforeach;
    }

    public function storeYearWeek() //necessary??
    {
      $year_weeks = CarbonPeriod::create(Carbon::create(now())->startOfYear(), Carbon::create(now())->endOfYear())->week();

      $num = 1;
      
      foreach($year_weeks as $year_week):
        $week = new Week();
        $week->week = $num ++;   //or date('W',2022-1-1);
        $week->date = $year_week;
        $week->user_id = Auth::user()->id;
        $week->save();
      endforeach;
    }

    public function storeYearMonth() //necessary??
    {
      $year_months = CarbonPeriod::create(Carbon::create(now())->startOfYear(), Carbon::create(now())->endOfYear())->month();

      foreach($year_months as $year_month):
        $month = new Month();
        $month->date = $year_month;
        $month->user_id = Auth::user()->id;
        $month->save();
      endforeach;

    }

    public function storeYear() //necessary??
    {
    //   $year = new Year;  
        $this->year->date    = Carbon::create(now())->startOfYear();
        $this->year->user_id = Auth::user()->id;

        $this->year->save();
    }

    public function storeYearLast() //necessary??
    {
        $year_last = new Year;

        $year_last->date    = Carbon::create(now())->subYear(1)->startOfYear();
        $year_last->user_id = Auth::user()->id;
        $year_last->save();

    }

    public function storeWholeYear(Request $request)  //Supposed to delete
    {

      // return $request->year;
      $year = CarbonPeriod::create(date($request->year.'-7-1'), date($request->year.'-7-31'));

      
              
        foreach($year as $year_day):
            // echo $date->format('Y-m-d-D');
            // echo "<br>";
          $day = new Day();
          $day->date = $year_day;
          $day->user_id = Auth::user()->id;
          $day->save();
        endforeach;

        return redirect()->back();
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

        // if($this->day->where('date', '=', $request->date)->doesntExist()):
        //     $this->storeMonthDays($request->date);
        // endif;
                
        $day = $this->day
                    ->where('date', '=',$request->date)
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

        return redirect()->back();
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


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Day  $day
     * @return \Illuminate\Http\Response
     */
    public function edit($day_id)
    {
      $day = $this->day->findOrFail($day_id);

      return view('diary.days.edit', compact('day'));
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
        $day = $this->day->findOrFail($day_id);
        $url = $request->url;
        $urls = str_replace('http://127.0.0.1:8000/', '', $url);

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
        return redirect($urls);
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Day  $day
     * @return \Illuminate\Http\Response
     */
    public function delete($day_id)
    {
      $day = $this->day->findOrFail($day_id);

      $this->deleteImage($day->image);
      
      $day->fact        = null;
      $day->discovery   = null;
      $day->lesson      = null;
      $day->next_action = null;
      $day->image       = null;

      $day->save();
      return redirect()->back();

    }

    public function destroy($user_id) //done
    {
        Day::where('user_id', $user_id)->delete();
        Week::where('user_id', $user_id)->delete();
        Month::where('user_id', $user_id)->delete();
        Year::where('user_id', $user_id)->delete();
        User::where('id', $user_id)->delete();

        return redirect('/');
    }
}
