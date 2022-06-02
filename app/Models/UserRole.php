<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    // table name
    protected $table = 'user_roles';

    //columns inside city (not sensitive data)
    protected $fillable = [
        'user_id', 'role_id'
    ];



    // relationships
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

}
