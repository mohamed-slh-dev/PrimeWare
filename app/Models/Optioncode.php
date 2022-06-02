<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Optioncode extends Model
{
    use HasFactory;

    // table name
    protected $table = 'optioncodes';

    //columns inside city (not sensitive data)
    protected $fillable = [
        'id', 'name', 'type'
    ];


    // relationships
    public function partners()
    {
        return $this->hasMany('App\Models\Partner');
    }

    public function customers()
    {
        return $this->hasMany('App\Models\Customer');
    }

    // singleorders
    public function singleorders()
    {
        return $this->hasMany('App\Models\Singleorder');
    }


    public function drivers()
    {
        return $this->hasMany('App\Models\Driver');
    }


    public function chargefees()
    {
        return $this->hasMany('App\Models\Chargefee');
    }

    public function otherchargefees()
    {
        return $this->hasMany('App\Models\Otherchargefee');
    }




    // hasOne
    public function samedistrict()
    {
        return $this->hasOne('App\Models\CityDistrict', 'district_id', 'id');
    }



    public function samecity()
    {
        return $this->hasOne('App\Models\CityDistrict', 'city_id', 'id');
    }

    


}
