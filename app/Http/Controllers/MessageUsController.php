<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageUsController extends Controller
{
    public function store(Request $r){
    	$this->validate($r, [
    		'name' => 'required',
    		'email' => 'email|required',
    		'number' => 'required',
    		'message' => 'required',
    	]);

    	return 'wew';
    }
}