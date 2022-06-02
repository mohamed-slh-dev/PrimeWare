<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otherchargefee extends Model
{
    use HasFactory;

    // table name
    protected $table = 'otherchargefees';

    //columns inside city (not sensitive data)
    protected $fillable = [
        'city_id', 'vantodayfees', 'vannextdayfees', 'biketodayfees', 'bikenextdayfees'
    ];



    // relationships
    public function city()
    {
        return $this->belongsTo('App\Models\Optioncode');
    }

}
