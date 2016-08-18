<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public function topic() {
     
        return $this->belongsTo('App\Topic');
    }
    public function message_relay() {
     
        return $this->belongsTo('App\MessageRelay');
    }
    
}
