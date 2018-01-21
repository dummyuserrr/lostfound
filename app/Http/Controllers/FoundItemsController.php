<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FoundItem;
use App\FoundItemImage;
use App\User;

class FoundItemsController extends Controller
{
    public function store(Request $r){
    	$this->validate($r, [
    		'name' => 'required',
    		'category' => 'required',
    		'place' => 'required',
            'datefound' => 'required',
    		'otherdetails' => 'required',
    		'images' => 'required',
    		'images.*' => 'mimes:jpeg,bmp,png,jpg',
    	]);

    	$l = new FoundItem;
    	$l->user_id = session('id');
    	$l->name = $r->name;
    	$l->category = $r->category;
    	$l->place = $r->place;
        $l->datefound = $r->datefound;
    	$l->otherdetails = $r->otherdetails;
    	$l->save();

    	foreach($r->images as $image){
    		$lii = new FoundItemImage;
    		$new = $image->store('/uploads/images');
    		$lii->image = $new;
    		$lii->found_item_id = $l->id;
    		$lii->save();
    	}

    	return back();
    }

    public function destroy(FoundItem $item){
        foreach($item->images as $image){
            $image->delete();
        }
        foreach($item->comments as $comment){
            $comment->delete();
        }
        $item->delete();
        return back();
    }

    public function search(Request $r){
        $li = new FoundItem;
        $categorySelected = $r->category;
        if($r->category == 'All'){
            $foundItems = $li->where('name', 'like', '%'.$r->q.'%')->orderBy('created_at', 'desc')->get();
            $q = $r->q;
            return view('found_search', compact('foundItems', 'q', 'categorySelected'));
        }else{
            $foundItems = $li->where('name', 'like', '%'.$r->q.'%')->where('category', $r->category)->orderBy('created_at', 'desc')->get();
            $q = $r->q;
            return view('found_search', compact('foundItems', 'q', 'categorySelected'));
        }
    }

    public function markAsFound(FoundItem $item){
        $item->update([
            'status' => 1,
        ]);

        return back();
    }
}
