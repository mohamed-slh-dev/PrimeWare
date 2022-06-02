<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    // table name
    protected $table = 'leaves';

    //columns inside city (not sensitive data)
    protected $fillable = [
        'user_id', 'status', 'datefrom', 'dateto', 'subject'
    ];


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
