<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use Redirect;
use Auth;
class User extends Model
{

        protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'username','password','email','name', 'lastname','birthdate', 'token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    'password', 'remember_token',
    ];

    public static function logout() {
            Session::flush();
            Auth::logout();
            return redirect('/');
    }
}
