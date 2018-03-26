<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MessageQuery;

class MessageQueryController extends Controller
{
    public function store(Request $r){
    	$this->validate($r, [
    		'name' => 'required',
    		'email' => 'email|required',
    		'number' => 'required',
    		'message' => 'required',
    	]);

    	$mq = new MessageQuery;
    	$mq->name = $r->name;
    	$mq->email = $r->email;
    	$mq->number = $r->number;
    	$mq->message = $r->message;
    	$mq->save();

    	return 1;
    }
}
