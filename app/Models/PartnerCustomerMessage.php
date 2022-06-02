<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerCustomerMessage extends Model
{
    use HasFactory;


    // table name
    protected $table = 'partner_customer_messages';

    //columns inside city (not sensitive data)
    protected $fillable = [
        'partner_id', 'customer_id', 'message', 'type', 'seen', 'date'
    ];


    public function partner()
    {
        return $this->belongsTo('App\Models\Partner');
    }


    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }


}
