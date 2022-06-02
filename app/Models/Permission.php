<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    // table name
    protected $table = 'permissions';

    //columns inside city (not sensitive data)
    protected $fillable = [
        'modulename', 'access', 'role_id'
    ];



    // relationships
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

}
