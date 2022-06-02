<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverDistricts extends Model
{
    use HasFactory;

    // table name
    protected $table = 'driver_districts';

    //columns inside city (not sensitive data)
    protected $fillable = [
        'id', 'driver_id', 'district_id'
    ];


    // relationships
    // belongsTo
    public function driver()
    {
        return $this->belongsTo('App\Models\Driver');
    }

    public function district()
    {
        return $this->belongsTo('App\Models\Optioncode');
    }

}
