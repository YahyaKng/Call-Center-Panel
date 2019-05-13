<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * Get the users with this role.
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
