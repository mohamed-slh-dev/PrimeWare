<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    // table name
    protected $table = 'messages';

    //columns inside city (not sensitive data)
    protected $fillable = [
        'partner_id', 'driver_id', 'message', 'type', 'seen', 'date'
    ];


    public function partner()
    {
        return $this->belongsTo('App\Models\Partner');
    }


    public function driver()
    {
        return $this->belongsTo('App\Models\Driver');
    }

    
}
