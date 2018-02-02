<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminPagesController extends Controller
{
    public function index(){
    	return view('adminpanel.login');
    }

    public function users(){
    	$u = new User;
    	if(session('role') == 'superadmin'){
    		$users = $u->where('id', '!=', session('id'))->where('role', '!=', 'superadmin')->get();
    		return view('adminpanel.users', compact('users'));
    	}else{

    	}
    	
    }
}
