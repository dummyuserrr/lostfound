<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LostItem;
use App\LostItemImage;
use App\User;

class LostItemsController extends Controller
{
    public function store(Request $r){
    	$this->validate($r, [
    		'name' => 'required',
    		'category' => 'required',
    		'place' => 'required',
    		'otherdetails' => 'required',
    		'images' => 'required',
    		'images.*' => 'mimes:jpeg,bmp,png,jpg',
    	]);

    	$l = new LostItem;
    	$l->user_id = session('id');
    	$l->name = $r->name;
    	$l->category = $r->category;
    	$l->place = $r->place;
    	$l->otherdetails = $r->otherdetails;
    	$l->save();

    	foreach($r->images as $image){
    		$lii = new LostItemImage;
    		$new = $image->store('/uploads/images');
    		$lii->image = $new;
    		$lii->lost_item_id = $l->id;
    		$lii->save();
    	}

    	return back();
    }
}
