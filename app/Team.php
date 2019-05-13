<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Foundation\Auth\User as Authenticatable;

class Team extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'slug', 
        'max_meal_break',
        'max_rest_break',
        'admin_id',
    ];

    /**
     * Get the users of this team.
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
