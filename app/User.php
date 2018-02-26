<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	protected $fillable = ['name', 'address', 'email', 'mobile', 'image', 'password', 'role', 'approved'];

    public function lost_items(){
    	return $this->hasMany(LostItem::class);
    }

    public function lost_item_comments(){
    	return $this->hasMany(LostItemComment::class);
    }

    public function conversations(){
    	return $this->hasMany(Conversation::class);
    }

    public function messages(){
    	return $this->hasMany(Message::class);
    }
}
