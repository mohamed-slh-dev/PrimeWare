<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Singleorder extends Model
{
    use HasFactory;

    // table name
    protected $table = 'singleorders';

    //columns inside city (not sensitive data)
    protected $fillable = [
        'customer_name', 'customer_phone', 'customer_address', 'customer_locationlink', 'partner_id', 'driver_id', 'city_id', 'district_id', 'servicetype', 'status', 'cashcollected', 'chargefees', 'payedfees', 'deliverydate', 'pickuptime', 'deliverytime', 'updatedate', 'meal'
    ];


    // relationships

    // partner
    public function partner()
    {
        return $this->belongsTo('App\Models\Partner');
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
