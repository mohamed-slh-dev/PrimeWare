<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityDistrict extends Model
{
    use HasFactory;


    // table name
    protected $table = 'city_districts';

    //columns inside city (not sensitive data)
    protected $fillable = [
        'city_id', 'district_id'
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
