<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherpartnerNotification extends Model
{
    use HasFactory;


    // table name
    protected $table = 'otherpartner_notifications';


    protected $fillable = [
        'shortinfo', 'longinfo', 'datetime', 'linkroute', 'otherpartner_id', 'seen', 'fromapp'
    ];


    public function otherpartner()
    {
        return $this->belongsTo('App\Models\Otherpartner');
    }


}
