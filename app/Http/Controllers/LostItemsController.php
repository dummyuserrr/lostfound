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
            'datelost' => 'required',
    		'otherdetails' => 'required',
    		'images' => 'required',
    		'images.*' => 'mimes:jpeg,bmp,png,jpg',
    	]);

    	$l = new LostItem;
    	$l->user_id = session('id');
    	$l->name = $r->name;
    	$l->category = $r->category;
    	$l->place = $r->place;
        $l->datelost = $r->datelost;
    	$l->otherdetails = $r->otherdetails;
    	$l->save();

    	foreach($r->images as $image){
    		$lii = new LostItemImage;
    		$new = $image->store('/uploads/images');
    		$lii->image = $new;
    		$lii->lost_item_id = $l->id;
    		$lii->save();
    	}

        storeLog(session('name')." added a new lost item.");

        sendSMS('lost');
    	return back();
    }

    public function destroy(LostItem $item){
        foreach($item->images as $image){
            $image->delete();
        }
        foreach($item->comments as $comment){
            $comment->delete();
        }
        $item->delete();
        storeLog(session('name')." deleted a lost item.");
        return back();
    }

    public function search(Request $r){
        $li = new LostItem;
        $categorySelected = $r->category;
        if($r->pangasinan_only){
            if($r->category == 'All'){
                $lostItems = $li->where('name', 'like', '%'.$r->q.'%')->where('place', 'like', '%pangasinan%')->orderBy('created_at', 'desc')->get();
                $q = $r->q;
                return view('lost_search', compact('lostItems', 'q', 'categorySelected'));
            }else{
                $lostItems = $li->where('name', 'like', '%'.$r->q.'%')->where('place', 'like', '%pangasinan%')->where('category', $r->category)->orderBy('created_at', 'desc')->get();
                $q = $r->q;
                return view('lost_search', compact('lostItems', 'q', 'categorySelected'));
            }
        }else{
            if($r->category == 'All'){
                $lostItems = $li->where('name', 'like', '%'.$r->q.'%')->orderBy('created_at', 'desc')->get();
                $q = $r->q;
                return view('lost_search', compact('lostItems', 'q', 'categorySelected'));
            }else{
                $lostItems = $li->where('name', 'like', '%'.$r->q.'%')->where('category', $r->category)->orderBy('created_at', 'desc')->get();
                $q = $r->q;
                return view('lost_search', compact('lostItems', 'q', 'categorySelected'));
            }
        }
    }

    public function markAsFound(LostItem $item){
        $item->update([
            'status' => 1,
        ]);

        storeLog(session('name')." marked a found item as retrieved");

        return back();
    }
}
