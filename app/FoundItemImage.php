<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoundItemImage extends Model
{
    public function founditem(){
    	return $this->belongsTo(FoundItem::class);
    }
}
