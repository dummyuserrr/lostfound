<?php
use App\Mail\JoinerMail;

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
