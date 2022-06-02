<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


    // table name
    protected $table = 'orders';

    //columns inside city (not sensitive data)
    protected $fillable = [
        'partner_id', 'customer_id', 'driver_id', 'servicetype', 'servicetiming', 'status', 'cashcollected', 'chargefees', 'bag', 'deliverydate', 'updatedate', 'receivedpic', 'info'
    ];



  


    // relationships
    // belongsTo
    public function partner()
    {
        return $this->belongsTo('App\Models\Partner');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function driver()
    {
        return $this->belongsTo('App\Models\Driver');
    }
    

    // hasMany
    public function collectedorders()
    {
        return $this->hasMany('App\Models\Collectedorder');
    }




}
