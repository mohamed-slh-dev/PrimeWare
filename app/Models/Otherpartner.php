<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otherpartner extends Model
{
    use HasFactory;



    // table name
    protected $table = 'otherpartners';

    //columns inside city (not sensitive data)
    protected $fillable = [
        'name', 'phone', 'email', 'portalemail', 'password', 'address', 'locationlink', 'info', 'startdate', 'enddate', 'logo', 'contract', 'city_id', 'district_id', 'priority', 'payedfees', 'collectiontimingfrom', 'collectiontimingto'
    ];


    // functions and relationships
    
    


    // belongs to
    // 3 from same table
    // public function type()
    // {
    //     return $this->belongsTo('App\Models\Optioncode', 'type_id', 'id');
    // }

    public function city()
    {
        return $this->belongsTo('App\Models\Optioncode', 'city_id', 'id');
    }

    public function district()
    {
        return $this->belongsTo('App\Models\Optioncode', 'district_id', 'id');
    }


    public function notifications()
    {
        return $this->hasMany('App\Models\UserNotification');
    }





    public function orders()
    {
        return $this->hasMany('App\Models\Othersingleorder');
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


    public function returnedcashes()
    {
        return $this->hasMany('App\Models\Returnedcash');
    }

  

}
