<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LostItem;

class PagesController extends Controller
{
    public function index(){
    	return view('index');
    }

    public function lost(){
    	$li = new LostItem;
    	$lostItems = $li->orderBy('created_at', 'desc')->get();
    	return view('lost', compact('lostItems'));
    }
}
