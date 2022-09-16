<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function countEntry($user_id)
    {
        $days = Day::where('user_id', $user_id)
                    ->Where(function($query) {
                        $query->orWhereNotNull('fact')
                            ->orWhereNotNull('discovery')
                            ->orWhereNotNull('lesson')
                            ->orWhereNotNull('next_action');
                        })
                    ->count();

        $weeks = Week::where('user_id', $user_id)
                    ->Where(function($query) {
                        $query->orWhereNotNull('fact')
                            ->orWhereNotNull('discovery')
                            ->orWhereNotNull('lesson')
                            ->orWhereNotNull('next_action');
                        })
                    ->count();

        $months = Month::where('user_id', $user_id)
                    ->Where(function($query) {
                        $query->orWhereNotNull('fact')
                            ->orWhereNotNull('discovery')
                            ->orWhereNotNull('lesson')
                            ->orWhereNotNull('next_action');
                        })
                    ->count();

        $years = Year::where('user_id', $user_id)
                    ->Where(function($query) {
                        $query->orWhereNotNull('fact')
                            ->orWhereNotNull('discovery')
                            ->orWhereNotNull('lesson')
                            ->orWhereNotNull('next_action');
                        })
                    ->count();

        
        $all_entries = $days + $weeks + $months + $years;

        return $all_entries;
    }
}
