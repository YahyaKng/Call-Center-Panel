<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email', 
        'password',
        'line',
        'status_id',
        'team_id',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the user`s role.
     */
    public function role()
    {
        return $this->belongsTo('App\Role');
    }
    
    /**
     * Get the user`s role.
     */
    public function team()
    {
        return $this->belongsTo('App\Team');
    }

    /**
     * Get the user`s role.
     */
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
}
