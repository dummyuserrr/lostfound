<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Mail;
use App\Mail\DeclinedMail;
use App\Mail\AcceptedMail;
use App\Mail\DeletedMail;

class UsersController extends Controller
{
    public function login(Request $r){
        if(session()->has('status')){
            return 3;
            exit();
        }
    	$u = new User;
    	$password = md5(hash('sha512', $r->password).hash('ripemd160', $r->password).md5("strongest"));
    	$user = $u->where('username', $r->username)->where('password', $password)->first();
    	if($user){
            if($user->approved == 0){
                return 2;
            }else{
                session()->put('status', 1);
                session()->put('id', $user->id);
                session()->put('username', $user->username);
                session()->put('role', $user->role);
                session()->put('name', $user->name);
                return 1;
            }
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
            $image = $r->image->store('uploads/images');
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

    public function register(Request $r){
        $this->validate($r, [
            'name' => 'required',
            'email' => 'email|required|unique:users',
            'mobile' => 'required',
            'address' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'password2' => 'same:password',
            'image' => 'required|mimes:jpeg,bmp,png,jpg',
        ]);

        $password = md5(hash('sha512', $r->password).hash('ripemd160', $r->password).md5("strongest"));
        $image = $r->image->store('uploads/images');

        $u = new User;
        $u->name = $r->name;
        $u->email = $r->email;
        $u->mobile = $r->mobile;
        $u->address = $r->address;
        $u->username = $r->username;
        $u->password = $password;
        $u->image = $image;
        $u->save();

        return 1;
    }

    public function destroy(User $item){
        // $item->lost_items()->delete();
        $item->lost_item_comments()->delete();
        // $item->found_items()->delete();
        $item->found_item_comments()->delete();
        // $item->conversations()->delete();
        // $item->messages()->delete();
        Mail::to($item->email)->queue(new DeletedMail($item->name));
        $item->delete();
        session()->flash('action', 'deleted');
        return back();
    }

    public function store_admin(Request $r){
        $this->validate($r, [
            'name' => 'required',
            'email' => 'email|required',
            'mobile' => 'required',
            'address' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'password2' => 'same:password',
            'image' => 'required|mimes:jpeg,bmp,png,jpg',
        ]);

        $password = md5(hash('sha512', $r->password).hash('ripemd160', $r->password).md5("strongest"));
        $image = $r->image->store('uploads/images');

        $u = new User;
        $u->name = $r->name;
        $u->email = $r->email;
        $u->mobile = $r->mobile;
        $u->address = $r->address;
        $u->username = $r->username;
        $u->password = $password;
        $u->image = $image;
        $u->role = 'admin';
        $u->save();

        session()->flash('action', 'added');
        return redirect('/admin-panel/users');
    }

    public function changeRole(User $user, $role){
        $user->update([
            'role' => $role,
        ]);

        session()->flash('action', 'updated');
        return back();
    }

    public function patch_other(User $user, Request $r){
        $this->validate($r, [
            'image' => 'sometimes|mimes:jpeg,bmp,png,jpg',
            'password' => 'sometimes',
            'password2' => 'sometimes|same:password',
            'name' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
        ]);

        $user->update([
            'name' => $r->name,
            'address' => $r->address,
            'email' => $r->email,
            'mobile' => $r->mobile,
        ]);

        if($r->image){
            $image = $r->image->store('uploads/images');
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

        session()->flash('successMessage', 'Account has been updated.');
        return back();
    }

    public function approve(User $user){
        $user->update([
            'approved' => 1,
        ]);
        Mail::to($user->email)->queue(new AcceptedMail($user->name));

        return back();
    }

    public function decline(User $user){
        Mail::to($user->email)->queue(new DeclinedMail($user->name));
        $user->delete();

        return back();
    }
}
