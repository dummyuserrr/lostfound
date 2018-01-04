<?php
use App\Mail\JoinerMail;

function setActive($path){
    if(Request::is($path . '*')){
    	return 'activenavlink';
    }
}

function adminSetActive($path){
    if(Request::is($path . '*')){
    	return 'active';
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
