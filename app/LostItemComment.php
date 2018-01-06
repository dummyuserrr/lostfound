<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LostItemComment extends Model
{
    public function lostitem(){
    	return $this->belongsTo(LostItem::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }
}
