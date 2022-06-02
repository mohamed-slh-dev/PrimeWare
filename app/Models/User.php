<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;


    // table name
    protected $table = 'users';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'email', 'password', 'avatar', 'department_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];



    // relationships
    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }

    public function leaves()
    {
        return $this->hasMany('App\Models\Leave');
    }


    public function notifications()
    {
        return $this->hasMany('App\Models\UserNotification');
    }

    public function role()
    {
        return $this->hasOne('App\Models\UserRole');
    }


    
    

}
