<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function messages(){
    	return $this->hasMany(Message::class);
    }

    public function participations(){
    	return $this->hasMany(Participation::class);
    }
}
