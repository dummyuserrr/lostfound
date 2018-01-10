<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function login(Request $r){
    	$u = new User;
    	$password = md5(hash('sha512', $r->password).hash('ripemd160', $r->password).md5("strongest"));
    	$user = $u->where('username', $r->username)->where('password', $password)->first();
    	if($user){
            session()->put('status', 1);
            session()->put('id', $user->id);
            session()->put('username', $user->username);
            session()->put('role', $user->role);
    		session()->put('name', $user->name);
    		return 1;
    	}else{
    		session()->forget('status');
            session()->forget('id');
            session()->forget('username');
            session()->forget('role');
    		session()->forget('name');
    		return 0;
    	}
    }

    public function logout(){
    	session()->forget('status');
        session()->forget('id');
        session()->forget('username');
        session()->forget('role');
		session()->forget('name');
		return redirect('/');
    }

    public function patch(Request $r){
        $this->validate($r, [
            'image' => 'sometimes|mimes:jpeg,bmp,png,jpg',
            'password' => 'sometimes',
            'password2' => 'sometimes|same:password',
            'name' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
        ]);

        $user = User::find(session('id'));
        $user->update([
            'name' => $r->name,
            'address' => $r->address,
            'email' => $r->email,
            'mobile' => $r->mobile,
        ]);

        if($r->image){
            $image = $r->image->store('/uploads/images');
            $user->update([
                'image' => $image,
            ]);
        }

        if($r->password){
            $password = md5(hash('sha512', $r->password).hash('ripemd160', $r->password).md5("strongest"));
            $user->update([
                'password' => $password,
            ]);
        }

        session()->flash('successMessage', 'Your account has been updated.');
        return back();
    }
}
