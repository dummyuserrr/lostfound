<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoundItemComment extends Model
{
    public function founditem(){
    	return $this->belongsTo(FoundItem::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }
}
