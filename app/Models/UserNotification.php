<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    use HasFactory;

    // table name
    protected $table = 'user_notifications';


    protected $fillable = [
        'shortinfo', 'longinfo', 'datetime', 'linkroute', 'user_id', 'partner_id', 'otherpartner_id', 'seen'
    ];


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function partner()
    {
        return $this->belongsTo('App\Models\Partner');
    }

    public function otherpartner()
    {
        return $this->belongsTo('App\Models\Otherpartner');
    }

}
