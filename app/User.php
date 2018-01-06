<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function lost_items(){
    	return $this->hasMany(LostItem::class);
    }
}
