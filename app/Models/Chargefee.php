<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chargefee extends Model
{
    use HasFactory;

    // table name
    protected $table = 'chargefees';

    //columns inside city (not sensitive data)
    protected $fillable = [
        'city_id', 'fees', 'partner_id'
    ];




    // relationships
    public function partner()
    {
        return $this->belongsTo('App\Models\Partner');
    }


    public function city()
    {
        return $this->belongsTo('App\Models\Optioncode');
    }


}
