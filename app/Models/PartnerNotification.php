<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerNotification extends Model
{
    use HasFactory;

    // table name
    protected $table = 'partner_notifications';


    protected $fillable = [
        'shortinfo', 'longinfo', 'datetime', 'linkroute', 'partner_id', 'seen', 'fromapp'
    ];


    public function partner()
    {
        return $this->belongsTo('App\Models\Partner');
    }
}
