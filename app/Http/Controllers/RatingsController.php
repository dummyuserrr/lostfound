<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rating;

class RatingsController extends Controller
{
    public function store(Request $r){
    	$this->validate($r, [
    		'rating' => 'required'
    	]);

    	$rat = new Rating;
    	$rat->user_id = session('id');
    	$rat->rating = $r->rating;
    	$rat->save();
		
		session()->flash('rated', '1');
		return back();
    }
}
