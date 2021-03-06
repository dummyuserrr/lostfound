<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LostItem extends Model
{
	protected $fillable = ['status'];

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function images(){
    	return $this->hasMany(LostItemImage::class);
    }

    public function comments(){
    	return $this->hasMany(LostItemComment::class);
    }
}
