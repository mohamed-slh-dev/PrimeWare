<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Returnedbag extends Model
{
    use HasFactory;

    // table name
    protected $table = 'returnedbags';

    //columns inside city (not sensitive data)
    protected $fillable = [
        'partner_id', 'driver_id', 'bags'
    ];


    // relationship
    public function partner()
    {
        return $this->belongsTo('App\Models\Partner');
    }

    public function driver()
    {
        return $this->belongsTo('App\Models\Driver');
    }
    
}
