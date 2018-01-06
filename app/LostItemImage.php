<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LostItemImage extends Model
{
    public function lostitem(){
    	return $this->belongsTo(LostItem::class);
    }
}
