<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Day;
use App\Models\Week;
use App\Models\Month;
use App\Models\Year;
use App\Http\Controllers\DayController;

class AdminController extends Controller
{

    public function showDashboard()
    {
        $users = User::where('role_id', 2)->orderBy('created_at', 'desc')->withTrashed()->paginate(10);

        return view('admin.dashboard')
                ->with('users', $users);
    }

    public function showUsers()
    {
        $users   = User::where('role_id', 2)->orderBy('created_at', 'desc')->withTrashed()->paginate(10);

        return view('admin.show.user')
                ->with('users', $users);
    }

    public function destroy($user_id)
    {
        $user = User::findOrFail($user_id);
        
        $user->delete();
        return redirect()->back();
    }
    
    public function destroyForce($user_id)
    {
        $user = User::withTrashed()->findOrFail($user_id);
        
        Day::where('user_id', $user_id)->delete();
        Week::where('user_id', $user_id)->delete();
        Month::where('user_id', $user_id)->delete();
        Year::where('user_id', $user_id)->delete();

        $image_days = Day::where('user_id', $user->id)->whereNotNull('image')->get();
        foreach($image_days as $image_day){
            app()->make(DayController::class)->deleteImage($image_day->image);
        } 

        $user->forceDelete();

        return redirect()->back();
    }

    public function restore($user_id)
    {
        $user = User::withTrashed()->findOrFail($user_id);
        $user->restore();

        return redirect()->back();
    }
}
