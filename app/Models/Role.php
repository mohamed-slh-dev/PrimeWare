<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // table name
    protected $table = 'roles';

    //columns inside city (not sensitive data)
    protected $fillable = [
        'name'
    ];



    // relationships
    public function permission()
    {
        return $this->hasOne('App\Models\Permission');
    }

    public function users()
    {
        return $this->hasMany('App\Models\UserRole');
    }

}
