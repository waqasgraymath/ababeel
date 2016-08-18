<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageRelay extends Model
{
    public function topic() {
     
        return $this->belongsTo('App\Topic');
    }
    
    public function logs() {
     
        return $this->hasMany('App\Log');
    }
}
