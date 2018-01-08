<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LostItemComment;
use App\User;
use App\LostItem;

class LostItemCommentsController extends Controller
{
	public function store(LostItem $item, Request $r){
		$lic = new LostItemComment;
		$lic->lost_item_id = $item->id;
		$lic->user_id = session('id');
		$lic->comment = $r->comment;
		$lic->save();

		$comment = $lic;

		// return view('templates.lost_items_comments', compact('comment'));
		return back();
	}
}
