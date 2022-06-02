<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collectedorder extends Model
{
    use HasFactory;

    // table name
    protected $table = 'collectedorders';

    //columns inside city (not sensitive data)
    protected $fillable = [
        'order_id', 'partner_id', 'customer_id', 'driver_id', 'servicetype', 'servicetiming', 'status', 'cashcollected', 'chargefees', 'bag', 'deliverydate', 'updatedate', 'info'
    ];


    // relationships
    // belongsTo
    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

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
}
