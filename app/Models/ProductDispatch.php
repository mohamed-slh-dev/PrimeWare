<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDispatch extends Model
{
    use HasFactory;

    // table name
    protected $table = 'product_dispatches';

    //columns inside city (not sensitive data)
    protected $fillable = [
        'product_id', 'status'
    ];



    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }

    public function flavors()
    {
        return $this->hasMany('App\Models\ProductDispatchFlavor');
    }

}
