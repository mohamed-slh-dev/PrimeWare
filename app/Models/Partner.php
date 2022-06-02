<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;


    // table name
    protected $table = 'partners';

    //columns inside city (not sensitive data)
    protected $fillable = [
        'name', 'phone', 'email', 'portalemail', 'password', 'address', 'locationlink', 'info', 'startdate', 'enddate', 'logo', 'contract', 'type_id', 'city_id', 'district_id', 'collectiontimingfrom', 'collectiontimingto', 'payedfees'
    ];


    // functions and relationships

    // belongs to
    // 3 from same table
    public function type()
    {
        return $this->belongsTo('App\Models\Optioncode', 'type_id', 'id');

    }

    public function city()
    {
        return $this->belongsTo('App\Models\Optioncode', 'city_id', 'id');

    }

    public function district()
    {
        return $this->belongsTo('App\Models\Optioncode', 'district_id', 'id');

    }


    // hasMany
    public function customers()
    {
        return $this->hasMany('App\Models\Customer');
    }

    public function ads()
    {
        return $this->hasMany('App\Models\Ads');
    }


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


    public function returnedcashes()
    {
        return $this->hasMany('App\Models\Returnedcash');
    }

    // single orders
    public function singleorders()
    {
        return $this->hasMany('App\Models\Singleorder');
    }


    public function messages()
    {
        return $this->hasMany('App\Models\Message');
    }

    public function withcustomermessages()
    {
        return $this->hasMany('App\Models\PartnerCustomerMessage');
    }


    public function notifications()
    {
        return $this->hasMany('App\Models\UserNotification');
    }


    public function chargefees()
    {
        return $this->hasMany('App\Models\Chargefee');
    }
    



}
