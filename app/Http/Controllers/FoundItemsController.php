<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FoundItem;
use App\LostItem;
use App\FoundItemImage;
use App\User;
use App\Notification;

class FoundItemsController extends Controller
{
    public function store(Request $r){
    	$this->validate($r, [
    		'name' => 'required',
    		'category' => 'required',
    		'place' => 'required',
            'datefound' => 'required',
            'timefound' => 'required',
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
        $l->timefound = $r->timefound;
    	$l->otherdetails = $r->otherdetails;
    	$l->save();

    	foreach($r->images as $image){
    		$lii = new FoundItemImage;
    		$new = $image->store('/uploads/images');
    		$lii->image = $new;
    		$lii->found_item_id = $l->id;
    		$lii->save();
    	}

        $li = new LostItem;
        $lostItems = $li->where('category', $r->category)->get();
        foreach($lostItems as $lostItem){
            $body = "A user has posted a found item with the category of ".$r->category;
            $url = "/found-something/item/".$l->id;
            storeNotification($lostItem->user_id, $body, $url);
        }

        storeLog(session('name')." added a found item.");

        // sendSMS('found');
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
        storeLog(session('name')." deleted a found item.");
        return back();
    }

    public function search(Request $r){
        $li = new FoundItem;
        $categorySelected = $r->category;
        if($r->pangasinan_only){
            if($r->category == 'All'){
                $foundItems = $li->where('name', 'like', '%'.$r->q.'%')->where('place', 'like', '%pangasinan%')->where('status', 0)->orderBy('created_at', 'desc')->get();
                $q = $r->q;
                return view('found_search', compact('foundItems', 'q', 'categorySelected'));
            }else{
                $foundItems = $li->where('name', 'like', '%'.$r->q.'%')->where('place', 'like', '%pangasinan%')->where('category', $r->category)->where('status', 0)->orderBy('created_at', 'desc')->get();
                $q = $r->q;
                return view('found_search', compact('foundItems', 'q', 'categorySelected'));
            }
        }else{
            if($r->category == 'All'){
                $foundItems = $li->where('name', 'like', '%'.$r->q.'%')->where('status', 0)->orderBy('created_at', 'desc')->get();
                $q = $r->q;
                return view('found_search', compact('foundItems', 'q', 'categorySelected'));
            }else{
                $foundItems = $li->where('name', 'like', '%'.$r->q.'%')->where('category', $r->category)->where('status', 0)->orderBy('created_at', 'desc')->get();
                $q = $r->q;
                return view('found_search', compact('foundItems', 'q', 'categorySelected'));
            }
        }
    }

    public function markAsFound(FoundItem $item){
        $item->update([
            'status' => 1,
        ]);

        storeLog(session('name')." marked a found item as retrieved");

        return back();
    }
}
