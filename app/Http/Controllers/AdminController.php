<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MailingController as Mail;
use Carbon\Carbon;
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

    public function permission(){

        $app_count = Db::table('tranquilo_permission_change')->count();

        if($app_count <> 0){

            $application = Db::table('tranquilo_permission_change')
                            ->join('tranquilo_users','tranquilo_permission_change.user_id','=','tranquilo_users.id')
                            ->join('tranquilo_application_status','tranquilo_permission_change.application_status','=','tranquilo_application_status.application_status_id')
                            ->get();

            $data['applications'] = $application;
        }

        $data['count'] = $app_count;


        return view('admin.permissionchange',$data);
    }

    public function approveLandlord(Request $request){

        $change_id = $request->input('change_id');

        Db::table('tranquilo_permission_change')->where('change_id',$change_id)->update(['application_status'=>3]);

        $info = Db::table('tranquilo_permission_change')->where('change_id',$change_id)->first();

        Db::table('tranquilo_users')->where('id',$info->user_id)->update('role',2);

        $mail = new Mail;

        $mail->LandlordApprove($info->user_id,$change_id);

    }

    public function declineLandlord(Request $request){

        $change_id = $request->input('change_id');

        Db::table('tranquilo_permission_change')->where('change_id',$change_id)->update(['application_status'=>4]);

        $info = Db::table('tranquilo_permission_change')->where('change_id',$change_id)->first();

        $mail = new Mail;

        $mail->LandlordReject($info->user_id,$change_id);

    }
}
