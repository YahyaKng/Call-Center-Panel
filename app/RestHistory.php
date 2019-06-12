<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestHistory extends Model
{
    protected $table = 'rest_history';

    protected $fillable = [
        'user_id',
        'team_id',
        'rest_type',
        'rest_status',
    ];

    /**
     * Get the user that wants to have break.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the team of user.
     */
    public function team()
    {
        return $this->belongsTo('App\Team');
    }
}
