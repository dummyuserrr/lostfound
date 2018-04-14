<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\MessageQuery;
use App\Log;
use App\LostItem;
use App\LostItemComment;
use App\LostItemImage;
use App\FoundItem;
use App\FoundItemComment;
use App\FoundItemImage;
use App\Message;
use App\Conversation;
use App\Participation;
use App\Rating;
use App\Notification;

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
            return 'Error. You are not an admin/superadmin';
    	}
    }

    public function users_new(){
        if(session('role') == 'superadmin' || session('role') == 'admin'){
            return view('adminpanel.users_new');
        }else{
            return 'Error. You are not an admin/superadmin';
        }
    }

    public function users_view(User $user){
        if(session('role') == 'superadmin' || session('role') == 'admin'){
            return view('adminpanel.users_view', compact('user'));
        }else{
            return 'Error. You are not an admin/superadmin';
        }
    }

    public function registrationRequests(){
        $u = new User;
        $users = $u->where('approved', 0)->orderBy('created_at')->get();
        return view('adminpanel.registrationRequests', compact('users'));
    }

    public function messageQueries(){
        $mq = new MessageQuery;
        $mqs = $mq->orderBy('created_at', 'desc')->get();
        foreach($mqs as $m){
            $m->update([
                'read' => 1
            ]);
        }
        return view('adminpanel.messageQueries', compact('mqs'));
    }

    public function systemLogs(){
        $l = new Log;
        $u = new User;
        $li = new LostItem;
        $logs = $l->orderBy('created_at', 'desc')->get();
        $users = $u->orderBy('created_at', 'desc')->get();
        $lostItems = $li->orderBy('created_at', 'desc')->get();
        return view('adminpanel.systemLogs', compact('logs', 'users', 'lostItems', 'lostItemImages', 'lostItemComments'));
    }
}
