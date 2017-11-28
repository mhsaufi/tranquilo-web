<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as Db;

class AdminController extends Controller
{
    public function index(Request $request){

    	return view('admin.authadmin.login');

    }

    public function register(){
    	return view('admin.authadmin.register');
    }

    public function home(){

    	
    	$r_count = Db::table('tranquilo_users')->count();

    	if($r_count <> 0){

    		$users = Db::table('tranquilo_users')
    			->join('tranquilo_users_role','tranquilo_users.role','=','tranquilo_users_role.role_id')
    			->join('tranquilo_users_status','tranquilo_users.status','=','tranquilo_users_status.user_status_id')
    			->latest('created_at')
    			->paginate(6);

    			$data['users'] = $users;

    	}

    	$status = Db::table('tranquilo_users_status')->get();

    	$data['status'] = $status;
    	$data['r_count'] = $r_count;

    	return view('admin.home',$data);
    }
}
