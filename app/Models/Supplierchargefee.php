<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplierchargefee extends Model
{
    use HasFactory;

    // table name
    protected $table = 'supplierchargefees';

    //columns inside city (not sensitive data)
    protected $fillable = [
        'city_id', 'fees', 'supplier_id'
    ];




    // relationships
    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier');
    }


    public function city()
    {
        return $this->belongsTo('App\Models\Optioncode');
    }
}
