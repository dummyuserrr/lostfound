<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminPagesController extends Controller
{
    public function index(){
    	return view('adminpanel.users');
    }

    public function users(){
    	$u = new User;
    	if(session('role') == 'superadmin' || session('role') == 'admin'){
    		$users = $u->where('id', '!=', session('id'))->where('role', '!=', 'superadmin')->get();
    		return view('adminpanel.users', compact('users'));
    	}else{
            return 'Error. You are not an admin';
    	}
    	
    }
}
