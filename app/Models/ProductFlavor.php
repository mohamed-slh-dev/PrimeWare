<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFlavor extends Model
{
    use HasFactory;

    // table name
    protected $table = 'product_flavors';

    //columns inside city (not sensitive data)
    protected $fillable = [
        'name', 'product_id', 'price', 'quantity', 'cals', 'proteins',
        'carbs', 'fats', 'received', 'available', 'sold', 'damaged',
    ];



    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }
    
}
