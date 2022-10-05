<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Week;
use App\Models\Month;
use App\Models\Year;
use App\Models\User;

class UserController extends Controller
{

    public function destroy($user_id)
    {
        $image_days = Day::where('user_id', $user_id)->whereNotNull('image')->get();
        foreach($image_days as $image_day){
            app()->make(DayController::class)->deleteImage($image_day->image);
        } 

        Day::where('user_id', $user_id)->delete();
        Week::where('user_id', $user_id)->delete();
        Month::where('user_id', $user_id)->delete();
        Year::where('user_id', $user_id)->delete();
        User::where('id', $user_id)->delete();

        return redirect('/');
    }

}
