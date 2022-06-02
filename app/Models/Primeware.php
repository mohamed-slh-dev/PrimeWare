<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Primeware extends Model
{
    use HasFactory;

    // table name
    protected $table = 'primeware';

    //columns inside city (not sensitive data)
    protected $fillable = [
        'name', 'phone', 'email'
    ];


}
