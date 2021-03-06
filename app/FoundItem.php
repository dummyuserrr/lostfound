<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoundItem extends Model
{
	protected $fillable = ['status'];

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function images(){
    	return $this->hasMany(FoundItemImage::class);
    }

    public function comments(){
    	return $this->hasMany(FoundItemComment::class);
    }
}
