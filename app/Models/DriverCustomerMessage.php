<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverCustomerMessage extends Model
{
    use HasFactory;


    // table name
    protected $table = 'driver_customer_messages';

    //columns inside city (not sensitive data)
    protected $fillable = [
        'driver_id', 'customer_id', 'message', 'type', 'seen', 'delivery_id', 'date'
    ];


    public function driver()
    {
        return $this->belongsTo('App\Models\Driver');
    }


    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }


}
