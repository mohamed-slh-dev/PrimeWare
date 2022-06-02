<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDispatchFlavor extends Model
{
    use HasFactory;

    // table name
    protected $table = 'product_dispatch_flavors';

    //columns inside city (not sensitive data)
    protected $fillable = [
        'product_dispatch_id', 'product_flavor_id', 'quantity', 'price',
    ];



    public function dispatch()
    {
        return $this->belongsTo('App\Models\ProductDispatch', 'product_dispatch_id', 'id');
    }


     public function flavor()
    {
        return $this->belongsTo('App\Models\ProductFlavor', 'product_flavor_id', 'id');
    }
}
