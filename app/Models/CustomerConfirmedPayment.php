<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerConfirmedPayment extends Model
{
    use HasFactory;

    // table name
    protected $table = 'customer_confirmed_payments';

    //columns inside city (not sensitive data)
    protected $fillable = [
        'customer_id', 'cashamount'
    ];




    public function customer()
    {
        
        return $this->belongsTo('App\Models\Customer');

    }
}
