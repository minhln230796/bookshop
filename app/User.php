<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'address',
        'phone',
        'birthday',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $guarded = ['id'];

    public function comments()
    {
        return $this->hasMany('App\Comment', 'user_id');
    }

    public function orders()
    {
        return $this->hasMany('App\Order', 'user_id');
    }

    public function rates()
    {
        return $this->hasMany('App\Rate', 'user_id');
    }

    public function scopeUpdate($arr)
    {
        if($arr['password'] != '')
        {
            $arr['password'] = Hash::make($arr['password']);
        }
        $this->save($arr);
    }
}
