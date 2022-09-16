<?php

namespace App\Http\Controllers;

use App\Models\UserNumber;
use App\Models\User;
use Illuminate\Http\Request;

class UserNumberController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $number = new UserNumber;

        $number->numbers = User::where('role_id', 2)->count();
        $number->save();

        return redirect('/');
    }

}
