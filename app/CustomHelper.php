<?php
use App\Mail\JoinerMail;
use App\Conversation;
use App\Participation;
use App\Message;
use App\User;
use App\LostItem;
use App\FoundItem;
use App\Rating;

function countRegistrationRequests(){
    $u = new User;
    $count = $u->where('approved', '0')->count();
    if($count > 0){
        return '('.$count.')';
    }
}

function computeRatings(){
    $r = new Rating;
    $count = $r->count();
    $ratings  = $r->all();
    $sum = 0;
    foreach($ratings as $rating){
        $sum += $rating->rating;
    }
    $average = $sum / $count;
    return $average;
}

function countRaters(){
    $r = new Rating;
    $count = $r->count();
    return $count;
}

function countRetrievedItems(){
    $li = new LostItem;
    $fi = new FoundItem;
    $count_li = $li->where('status', 1)->count();
    $count_fi = $fi->where('status', 1)->count();
    $total = $count_fi + $count_li;
    return $total;
}

function checkIfRated(){
    $user = User::find(session('id'));
    if($user->ratings()->count() > 0){
        return 1;
    }
}

function countUnreadMessages(){
    $messagesCount = 0;
    $count = 0;
    $p = new Participation;
    $myParticipations = $p->where('user_id', session('id'))->get();
    if(count($myParticipations) > 0){
        foreach($myParticipations as $myParticipation){
            $messagesCount = $messagesCount + $myParticipation->conversation->messages->where('user_id', '!=', session('id'))->where('seenby', '!=', session('id'))->count();
        }
        if($messagesCount == 0){
            return '';
        }else{
            return $messagesCount;
        }
    }else{
        return '';
    }
}

function setActive($path){
    if(Request::is($path . '*')){
    	return 'activenavlink';
    }
}

function navSetActive($path){
    if(Request::is($path . '*')){
    	return 'link_active';
    }
}

function adminSetActive2($path){
    if(Request::is($path . '*')){
    	return 'mydropdown_active';
    }
}

function checkCurrentDirectory($path){
    if(Request::is($path)){
    	return 'true';
    }
}

function adminSetActive3($path){
    if(Request::is($path . '*')){
        return 'active';
    }
}