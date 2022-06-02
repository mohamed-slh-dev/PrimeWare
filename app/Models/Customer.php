<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Customer extends Authenticatable implements JWTSubject
{
    use HasFactory;

    // table name
    protected $table = 'customers';

    //columns inside city (not sensitive data)
    protected $fillable = [
        'name', 'phone', 'flatnumber', 'address', 'blocknumber', 'locationlink', 'servicetype', 'servicetiming', 'deliverydaysnumber', 'deliverydays', 'cashcollected', 'substartdate', 'subenddate', 'info', 'specialpickuptime', 'specialdeliverytime', 'partner_id', 'linkedcustomer', 'city_id', 'district_id', 'totalbags', 'totalfees', 'onlinestatus'
    ];


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    // relationships
    // 2 from same table
    public function city()
    {
        return $this->belongsTo('App\Models\Optioncode', 'city_id', 'id');

    }

    public function district()
    {
        return $this->belongsTo('App\Models\Optioncode', 'district_id', 'id');

    }



    
    // belongsTo
    public function partner()
    {
        return $this->belongsTo('App\Models\Partner');
    }




    // hasmany
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





    // hasmany
    public function collectedorders()
    {
        return $this->hasMany('App\Models\Collectedorder');
    }


    public function renews()
    {
        return $this->hasMany('App\Models\CustomerRenew');
    }


    public function withpartnermessages()
    {
        return $this->hasMany('App\Models\PartnerCustomerMessage');
    }


    public function withdrivermessages()
    {
        return $this->hasMany('App\Models\DriverCustomerMessage');
    }

   
    public function confirmedpayment()
    {
        return $this->hasOne('App\Models\CustomerConfirmedPayment');
    }

}
