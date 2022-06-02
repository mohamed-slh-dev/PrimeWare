<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerRenew extends Model
{
    use HasFactory;


    // table name
    protected $table = 'customer_renews';

    //columns inside city (not sensitive data)
    protected $fillable = [
        'customer_id', 'startdate', 'enddate', 'deliveriescount'
    ];




    public function customer()
    {
        
        return $this->belongsTo('App\Models\Customer');

    }

}
