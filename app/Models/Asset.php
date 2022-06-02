<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    // table name
    protected $table = 'assets';

    //columns inside city (not sensitive data)
    protected $fillable = [
        'name', 'model', 'pic', 'serialnumber', 'status', 'info', 'driver_id'
    ];



    // relationships
    public function driver()
    {
        return $this->belongsTo('App\Models\Driver');
    }
    
}
