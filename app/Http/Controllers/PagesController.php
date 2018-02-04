<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LostItem;
use App\FoundItem;
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
    	$lostItems = $li->where('status', 0)->orderBy('created_at', 'desc')->get();
    	return view('lost', compact('lostItems'));
    }

    public function found(){
        $fi = new FoundItem;
        $foundItems = $fi->where('status', 0)->orderBy('created_at', 'desc')->get();
        return view('found', compact('foundItems'));
    }

    public function userView(User $user){
    	return view('user_view', compact('user'));
    }

    public function myAccount(){
    	$user = User::find(session('id'));
    	return view('my_account', compact('user'));
    }

    public function user_edit(User $user){
        return view('user_edit', compact('user'));
    }

    public function messages_empty(){
        $p = new Participation;
        $myParticipations = $p->where('user_id', session('id'))->orderBy('updated_at', 'desc')->get();
        $messages = NULL;
        $conversation = NULL;
        $user = NULL;
        return view('messages', compact('myParticipations', 'user', 'messages', 'conversation'));
    }

    public function messages(User $user){
        // retrieve all your conversations
        $p = new Participation;
        $myParticipations = $p->where('user_id', session('id'))->orderBy('updated_at', 'desc')->get();
        $messages = NULL;
        $conversation = NULL;
        // check if you have participations
        if(count($myParticipations) > 0){
            foreach($myParticipations as $myParticipation){
                // check if a participation matches the other user's participation
                $participationMatch = $p->where('user_id', $user->id)->where('conversation_id', $myParticipation->conversation_id)->first();
            }
            // if a participation with same conversation ID exists (you have messages to each other vv)
            if($participationMatch){
                $m = new Message;
                $messages = $participationMatch->conversation->messages;
                foreach($messages as $message){
                    // update message if seen
                    $message->update(['seenby' => session('id')]);
                }
                $conversation = $participationMatch->conversation;
                return view('messages', compact('myParticipations', 'user', 'messages', 'conversation'));
            }else{
                // no messages
                return view('messages', compact('myParticipations', 'user', 'messages', 'conversation'));
            }
            
        }else{
            // no participations
            return view('messages', compact('myParticipations', 'user', 'messages', 'conversation'));
        }
    }

    public function retrievedItems(){
        $li = new LostItem;
        $fi = new FoundItem;

        $lostItems = $li->where('status', 1)->orderBy('updated_at', 'desc')->get();
        $foundItems = $fi->where('status', 1)->orderBy('updated_at', 'desc')->get();
        return view('retrievedItems', compact('lostItems', 'foundItems'));
    }

    public function retrievedItemsSearch(Request $r){
        $li = new LostItem;
        $fi = new FoundItem;
        $categorySelected = $r->category;
        if($r->category == 'All'){
            $foundItems = $fi->where('name', 'like', '%'.$r->q.'%')->where('status', 1)->orderBy('created_at', 'desc')->get();
            $lostItems = $li->where('name', 'like', '%'.$r->q.'%')->where('status', 1)->orderBy('created_at', 'desc')->get();
            $q = $r->q;
            return view('retrieved_search', compact('foundItems', 'lostItems', 'q', 'categorySelected'));
        }else{
            $foundItems = $fi->where('name', 'like', '%'.$r->q.'%')->where('status', 1)->where('category', $r->category)->orderBy('created_at', 'desc')->get();
            $lostItems = $li->where('name', 'like', '%'.$r->q.'%')->where('status', 1)->where('category', $r->category)->orderBy('created_at', 'desc')->get();
            $q = $r->q;
            return view('retrieved_search', compact('foundItems', 'lostItems', 'q', 'categorySelected'));
        }
    }
}
