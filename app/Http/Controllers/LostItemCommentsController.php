<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LostItemComment;
use App\User;
use App\LostItem;

class LostItemCommentsController extends Controller
{
	public function store(LostItem $item, Request $r){
		$comment = new LostItemComment;
		$comment->lost_item_id = $item->id;
		$comment->user_id = session('id');
		$comment->comment = $r->comment;
		$comment->save();
		return view('templates.lost_items_comments', compact('comment'));
		// return view('templates.lost_items_comments');
	}
}
