<?php

namespace App\Http\Controllers;

use App\Models\Day;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DayController extends Controller
{

    const LOCAL_STORAGE_FOLDER = 'public/images/';
    
    public function create()
    { 
        return view('diary.days.create');
    }


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
        $days = Day::getRegularDate();

        return view('diary.regular.show.list')
                ->with('days', $days);
    }


    public function showRegularCard()
    {
        $days = Day::getRegularDate();

        return view('diary.regular.show.card')
                ->with('days', $days);
    }


    public function edit($day_id)
    {
        $day = Day::findOrFail($day_id);

        return view('diary.days.edit')->with('day', $day);
    }

    public function update(Request $request, $day_id)
    {
        $day = Day::findOrFail($day_id);
        $url = $request->url;

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
}
