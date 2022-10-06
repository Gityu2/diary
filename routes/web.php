<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DayController;
use App\Http\Controllers\DayLikeController;
use App\Http\Controllers\MonthController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WeekController;
use App\Http\Controllers\YearController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserNumberController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('top');
});

Auth::routes();

Route::group(['middleware' => 'auth'],function(){

    Route::group(['prefix' => 'diary', 'as' => 'diary.'] ,function(){
        Route::group(['prefix' => 'day', 'as' => 'day.'] ,function(){
            Route::get('/create',[DayController::class, 'create'])->name('create');
            Route::post('/store',[DayController::class, 'store'])->name('store');
            Route::get('/edit/{day_id}',[DayController::class, 'edit'])->name('edit');
            Route::patch('/update/{day_id}',[DayController::class, 'update'])->name('update');
            Route::patch('/reset/{day_id}',[DayController::class, 'reset'])->name('reset');
            
            Route::get('/show/regular/list',[DayController::class, 'showRegularList'])->name('show.regular.list');
            Route::get('/show/regular/card',[DayController::class, 'showRegularCard'])->name('show.regular.card');
        });
    
    
    Route::group(['prefix' => 'week', 'as' => 'week.'], function(){
        Route::get('/edit/{week_id}',[WeekController::class, 'edit'])->name('edit');
        Route::patch('/update/{week_id}',[WeekController::class, 'update'])->name('update');
        Route::patch('/reset/{week_id}',[WeekController::class, 'reset'])->name('reset');
    });
    
    
    Route::group(['prefix' => 'month', 'as' => 'month.'] ,function(){
        Route::get('/show/list',[MonthController::class, 'showList'])->name('show.list');
        Route::get('/show/card',[MonthController::class, 'showCard'])->name('show.card');
        Route::get('/edit/{month_id}',[MonthController::class, 'edit'])->name('edit');
        Route::patch('/update/{month_id}',[MonthController::class, 'update'])->name('update');
        Route::patch('/reset/{month_id}',[MonthController::class, 'reset'])->name('reset');
    });
    
    
    Route::group(['prefix' => 'year', 'as' => 'year.'], function(){
        Route::get('/show', [YearController::class, 'show'])->name('show');
        Route::get('/edit/{year_id}', [YearController::class, 'edit'])->name('edit');
        Route::patch('/update/{year_id}',[YearController::class, 'update'])->name('update');
        Route::patch('/reset/{year_id}',[YearController::class, 'reset'])->name('reset');
    });
    
    Route::group(['prefix' => 'like', 'as' => 'like.'], function(){
        Route::post('/store/{day_id}', [DayLikeController::class, 'store'])->name('store');
        Route::delete('/destroy/{day_id}', [DayLikeController::class, 'destroy'])->name('destroy');
        Route::get('/show/list', [DayLikeController::class, 'showList'])->name('show.list');
        Route::get('/show/card', [DayLikeController::class, 'showCard'])->name('show.card');
    });
    
    Route::group(['prefix' => 'search', 'as' => 'search.'], function(){
        Route::get('/show/list', [SearchController::class, 'showList'])->name('show.list');
        Route::get('/show/card', [SearchController::class, 'showCard'])->name('show.card');
    });
    
    Route::delete('/destroy/{user_id}',[UserController::class, 'destroy'])->name('destroy');

    });



});

Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'as' => 'admin.'],function(){
    Route::get('/show/dashboard',[AdminController::class, 'showDashboard'])->name('show.dashboard');
    Route::get('/show/users',[AdminController::class, 'showUsers'])->name('show.users');
    Route::delete('/destroy/soft/{user_id}',[AdminController::class, 'destroy'])->name('destroy');
    Route::delete('/destroy/force/{user_id}',[AdminController::class, 'destroyForce'])->name('destroy.force');
    Route::get('/restore/user/{user_id}',[AdminController::class, 'restore'])->name('restore');

    Route::get('/store/numbers', [UserNumberController::class, 'store'])->name('store.numbers');

});