<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Othersingleorder extends Model
{
    use HasFactory;


    // table name
    protected $table = 'othersingleorders';

    //columns inside city (not sensitive data)
    protected $fillable = [
        'otherpartner_id', 'driver_id', 'city_id', 'district_id', 'referenceid', 'customer_name', 'customer_phone', 'customer_address', 'customer_locationlink', 'packagetype', 'carriage',  'servicetype', 'status', 'paymentstatus', 'chargefees', 'deliverydate', 'pickuplocationlink', 'pickuptime', 'deliverytime', 'updatedate', 'info', 'numberofcarriage'
    ];



    // relationships

    // partner
    public function otherpartner()
    {
        return $this->belongsTo('App\Models\Otherpartner');
        
    }

    // driver
    public function driver()
    {
        return $this->belongsTo('App\Models\Driver');
    }



    // city
    public function city()
    {
        return $this->belongsTo('App\Models\Optioncode', 'city_id', 'id');

    }

    
    // district
    public function district()
    {
        return $this->belongsTo('App\Models\Optioncode', 'district_id', 'id');

    }


}
