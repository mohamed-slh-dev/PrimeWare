<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    // table name
    protected $table = 'suppliers';

    //columns inside city (not sensitive data)
    protected $fillable = [
        'name', 'phone', 'email', 'portalemail', 'password', 'address', 'locationlink', 'info', 'startdate', 'enddate', 'logo', 'city_id', 'district_id', 'contract'
    ];



    public function city()
    {
        return $this->belongsTo('App\Models\Optioncode', 'city_id', 'id');

    }

    public function district()
    {
        return $this->belongsTo('App\Models\Optioncode', 'district_id', 'id');

    }
    
}
