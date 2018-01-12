<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Conversation;
use App\Participation;
use App\Message;

class ConversationsController extends Controller
{
    public function store($conversation, User $user, Request $r){
    	// check if a conversation exists between you and that user
    	if($conversation == 0){
    		// create a new convo
    		$c = new Conversation;
    		$c->save();
    		$newConvo = $c;

    		// create a new participation for you
    		$p = new Participation;
    		$p->user_id = session('id');
    		$p->conversation_id = $newConvo->id;
    		$p->save();

    		// create a new participation for other user
    		$p = new Participation;
    		$p->user_id = $user->id;
    		$p->conversation_id = $newConvo->id;
    		$p->save();

    		// create a new message
    		$m = new Message;
    		$m->conversation_id = $newConvo->id;
    		$m->user_id = session('id');
    		$m->body = $r->message;
    		$m->save();

    		return back();

    	}else{ // if a conversation already exists
    		$ourConvo = Conversation::find($conversation);

    		$m = new Message;
    		$m->conversation_id = $ourConvo->id;
    		$m->user_id = session('id');
    		$m->body = $r->message;
    		$m->save();

    		return back();
    	}
    }
}
