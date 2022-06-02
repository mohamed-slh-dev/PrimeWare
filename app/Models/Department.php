<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    // table name
    protected $table = 'departments';

    //columns inside city (not sensitive data)
    protected $fillable = [
        'name'
    ];



    // relationships
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

}
