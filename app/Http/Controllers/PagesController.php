<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LostItem;
use App\User;
use App\Message;
use App\Participation;
use App\Conversation;

class PagesController extends Controller
{
    public function index(){
    	return view('index');
    }

    public function lost(){
    	$li = new LostItem;
    	$lostItems = $li->where('status', 0)->orderBy('created_at', 'desc')->paginate(1);
    	return view('lost', compact('lostItems'));
    }

    public function userView(User $user){
    	return view('user_view', compact('user'));
    }

    public function myAccount(){
    	$user = User::find(session('id'));
    	return view('my_account', compact('user'));
    }

    public function messages(User $user){
        // retrieve all your conversations
        $p = new Participation;
        $myParticipations = $p->where('user_id', session('id'))->orderBy('updated_at', 'desc')->get();

        // check if a convo exists between you and that user
        if(count($myParticipations) > 0){
            foreach($myParticipations as $myParticipation){
                // check if participation matches the other user's participation
                $participationMatch = $p->where('user_id', $user->id)->where('conversation_id', $myParticipation->conversation_id)->first();
            }
            if($participationMatch){
                $m = new Message;
                $messages = $participationMatch->conversation->messages;
                foreach($messages as $message){
                    // panasend
                    $message->update(['seenby' => session('id')]);
                }
                return view('messages.messages', compact('messages'));
            }else{
                return "<center>You have no messages</center>";
            }
            
        }else{
            return "<center>You have no participations</center>";
        }

        return view('messages', compact('myParticipations', 'user'));
    }
}
