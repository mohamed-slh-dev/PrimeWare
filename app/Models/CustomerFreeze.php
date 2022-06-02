<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerFreeze extends Model
{
    use HasFactory;


    // table name
    protected $table = 'customer_freezes';

    //columns inside city (not sensitive data)
    protected $fillable = [
        'customer_id', 'startingdate', 'endingdate'
    ];




    public function customer()
    {
        
        return $this->belongsTo('App\Models\Customer');

    }
}
