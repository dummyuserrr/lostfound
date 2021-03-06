<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FoundItemComment;
use App\User;
use App\FoundItem;

class FoundItemCommentsController extends Controller
{
    public function store(FoundItem $item, Request $r){
		$comment = new FoundItemComment;
		$comment->found_item_id = $item->id;
		$comment->user_id = session('id');
		$comment->comment = $r->comment;
		$comment->save();

		$foundItem_user = $item->user_id;
		$body = 'A user has commented on your posted item named '.$item->name;
		storeNotification($foundItem_user, $body);
		return view('templates.found_items_comments', compact('comment'));
	}

	public function destroy(FoundItem $founditem, FoundItemComment $item){
		$item->delete();
		return 1;
	}
}
