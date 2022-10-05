<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Week;
use App\Models\Month;
use App\Models\Year;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    const LOCAL_STORAGE_FOLDER = 'public/images/';

    public function destroy($user_id)
    {
        $days = Day::where('user_id', $user_id)->get();
        foreach($days as $day){
            $this->deleteImage($day->image);
        };
        
        $days->delete();
        Week::where('user_id', $user_id)->delete();
        Month::where('user_id', $user_id)->delete();
        Year::where('user_id', $user_id)->delete();
        User::where('id', $user_id)->delete();

        return redirect('/');
    }

    public function deleteImage($image_name)
    {
        $image_path = self::LOCAL_STORAGE_FOLDER . $image_name;

        if(Storage::disk('local')->exists($image_path)):
            Storage::disk('local')->delete($image_path);
        endif;
    }
}
