<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Returnedcash extends Model
{
    use HasFactory;


    // table name
    protected $table = 'returnedcashes';

    //columns inside city (not sensitive data)
    protected $fillable = [
        'partner_id', 'driver_id', 'amount', 'comment', 'status', 'date' 
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
