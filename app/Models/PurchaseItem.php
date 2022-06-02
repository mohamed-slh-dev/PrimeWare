<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    use HasFactory;


    // table name
    protected $table = 'purchase_items';

    //columns inside city (not sensitive data)
    protected $fillable = [
        'purchase_id', 'product_id', 'product_flavor_id', 'quantity', 'price'
    ];




    public function purchase()
    {
        return $this->belongsTo('App\Models\Purchase', 'purchase_id', 'id');

    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');

    }


    public function flavor()
    {
        return $this->belongsTo('App\Models\ProductFlavor', 'product_flavor_id', 'id');

    }

    

}
