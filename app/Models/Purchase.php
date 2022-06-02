<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    // table name
    protected $table = 'purchases';

    //columns inside city (not sensitive data)
    protected $fillable = [
        'fname', 'lname', 'email', 'phone', 'city_id', 'district_id', 'address', 'block', 'floor', 'flat', 'location', 'status', 'delivery_date', 'price', 'tracking_number', 'delivery_price', 'driver_id',
    ];




    public function city()
    {
        return $this->belongsTo('App\Models\Optioncode', 'city_id', 'id');

    }

    public function district()
    {
        return $this->belongsTo('App\Models\Optioncode', 'district_id', 'id');

    }

    public function driver()
    {
        return $this->belongsTo('App\Models\Driver', 'driver_id', 'id');

    }

    public function items()
    {
        return $this->hasMany('App\Models\PurchaseItem');
    }
    
}
