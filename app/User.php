<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use \HighIdeas\UsersOnline\Traits\UsersOnlineTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'displayname','username', 'email', 'password', 'secret_question', 'secret_answer', 'group_id', 'practice_id', 'active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function getOnlineDoctors()
    {
        return  \DB::table('sessions as s')
                ->join('users as u','s.user_id','=','u.id')
                ->whereNotNull('s.last_activity')
                ->whereNotNull('s.user_id')
                ->where('u.group_id',2)
                ->pluck('u.id')->toArray();
    }
}
