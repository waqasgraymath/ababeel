<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function logs()
    {
        return $this->hasMany('App\Log');
    }
    
    public function message_relays()
    {
        return $this->hasMany('App\MessageRelay');
    }
}
