<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;

    protected $table = 'partner_ads';

    //columns inside city (not sensitive data)
    protected $fillable = [
        'title', 'price', 'pic', 'partner_id','label'
    ];

    public function driver()
    {
        return $this->belongsTo('App\Models\Partner');
    }
}
