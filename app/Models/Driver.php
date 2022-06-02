<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Driver extends Authenticatable implements JWTSubject
{
    use HasFactory;


    // table name
    protected $table = 'drivers';

    //columns inside city (not sensitive data)
    protected $fillable = [
        'name', 'phone', 'info', 'pic', 'type', 'shift', 'onlinestatus', 'platenumber', 'drivinglicense', 'licensepic', 'carpic', 'city_id'
    ];


    // relationships
    // 2 from same table
    public function city()
    {
        return $this->belongsTo('App\Models\Optioncode', 'city_id', 'id');

    }


    

    // hasMany
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
    

    // + sub relation operation from orders
    public function deliveredorders()
    {
        return $this->orders()->where('status', "delivered");
    }

    public function canceledorders()
    {
        return $this->orders()->where('status', "canceled");
    }






    public function collectedorders()
    {
        return $this->hasMany('App\Models\Collectedorder');
    }

    public function returnedbags()
    {
        return $this->hasMany('App\Models\Returnedbag');
    }



    // hasMany
    public function districts()
    {
        return $this->hasMany('App\Models\DriverDistricts');
    }


    // singleorders
    public function singleorders()
    {
        return $this->hasMany('App\Models\Singleorder');
    }


    // assets
    public function assets()
    {
        return $this->hasMany('App\Models\Asset');
    }



    public function messages()
    {
        return $this->hasMany('App\Models\Message');
    }


    public function withcustomermessages()
    {
        return $this->hasMany('App\Models\DriverCustomerMessage');
    }



    public function returnedcashes()
    {
        return $this->hasMany('App\Models\Returnedcash');
    }


    public function purchases()
    {
        return $this->hasMany('App\Models\Purchase');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

}
