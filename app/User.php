<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	protected $fillable = ['address', 'email', 'mobile', 'image', 'password', 'role', 'approved'];

    public function lost_items(){
    	return $this->hasMany(LostItem::class);
    }

    public function lost_item_comments(){
    	return $this->hasMany(LostItemComment::class);
    }
}
