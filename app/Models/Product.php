<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // table name
    protected $table = 'products';

    //columns inside city (not sensitive data)
    protected $fillable = [
        'name', 'ingredients', 'supplier_id', 'img', 'hidden'
    ];



    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier', 'supplier_id', 'id');
    }


    public function flavors()
    {
        return $this->hasMany('App\Models\ProductFlavor');
    }

    public function dispatches()
    {
        return $this->hasMany('App\Models\ProductDispatch');
    }


    public function purchases()
    {
        return $this->hasMany('App\Models\PurchaseItem');
    }

}
