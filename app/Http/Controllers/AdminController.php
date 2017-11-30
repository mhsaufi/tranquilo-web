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

    	
    	$users_count = Db::table('tranquilo_users')->count();
        $properties_count = Db::table('tranquilo_model')->count();
        $deal_count = Db::table('tranquilo_deal')->count();

        $model = Db::table('tranquilo_model')
                    ->where('tranquilo_model.m_view','>',100)
                    ->orWhere('tranquilo_model.m_rate_value','>',3)
                    ->join('tranquilo_users','tranquilo_model.m_owner','=','tranquilo_users.id')
                    ->join('tranquilo_state','tranquilo_model.m_state','=','tranquilo_state.state_id')
                    ->join('tranquilo_house_type','tranquilo_model.m_h_type','=','tranquilo_house_type.h_type_id')
                    ->get();

        $reviews = Db::table('tranquilo_review')
                ->select('tranquilo_review.review_id','tranquilo_review.review_content','tranquilo_review.review_status','tranquilo_review_status.review_status_title',
                        'tranquilo_review.user_id','tranquilo_users.name','tranquilo_review.review_date')
                ->join('tranquilo_review_status','tranquilo_review.review_status','=','tranquilo_review_status.review_status_id')
                ->join('tranquilo_users','tranquilo_review.user_id','=','tranquilo_users.id')
                ->get();

        $data['models'] = $model;
        $data['reviews'] = $reviews;
        $data['users'] = $users_count;
        $data['properties'] = $properties_count;
        $data['deals'] = $deal_count; 

    	return view('admin.home',$data);
    }

    public function user(Request $request){

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

        return view('admin.usersrecords',$data);

    }

    public function permission(){

        $app_count = Db::table('tranquilo_permission_change')->count();

        if($app_count <> 0){

            $application = Db::table('tranquilo_permission_change')
                            ->join('tranquilo_users','tranquilo_permission_change.user_id','=','tranquilo_users.id')
                            ->join('tranquilo_application_status','tranquilo_permission_change.application_status','=','tranquilo_application_status.application_status_id')
                            ->paginate(10);

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

    public function propertyRecords(Request $request){

        $r_count = Db::table('tranquilo_model')->count();

        if($r_count <> 0){

            $model = Db::table('tranquilo_model')
                    ->join('tranquilo_state','tranquilo_model.m_state','=','tranquilo_state.state_id')
                    ->join('tranquilo_house_type','tranquilo_model.m_h_type','=','tranquilo_house_type.h_type_id')
                    ->join('tranquilo_users','tranquilo_model.m_owner','=','tranquilo_users.id')
                    ->paginate(15);

            $data['models'] = $model;

        }

        $data['r_count'] = $r_count;

        return view('admin.propertyrecords',$data);
    }

    public function viewProperty(Request $request){

        $m_id = $request->input('m');

        $model = Db::table('tranquilo_model')
                    ->where('m_id',$m_id)
                    ->join('tranquilo_users','tranquilo_model.m_owner','=','tranquilo_users.id')
                    ->join('tranquilo_state','tranquilo_model.m_state','=','tranquilo_state.state_id')
                    ->join('tranquilo_house_type','tranquilo_model.m_h_type','=','tranquilo_house_type.h_type_id')
                    ->first();

        $created = Carbon::parse($model->created_at);
        $model->created_at = $created->toFormattedDateString();

        $data['model'] = $model;

        return view ('admin.viewproperty',$data);

    }

    public function dealRecords(Request $request){

        $query =  "
        SELECT * FROM tranquilo_model 
        INNER JOIN tranquilo_state ON tranquilo_model.m_state = tranquilo_state.state_id 
        INNER JOIN tranquilo_house_type ON tranquilo_model.m_h_type = tranquilo_house_type.h_type_id";

        $model_in = Db::raw('('.$query.') as model');

        $model_count = Db::table('tranquilo_deal')
                ->join($model_in,'tranquilo_deal.d_model','=','model.m_id')
                ->join('tranquilo_business_type','tranquilo_deal.d_b_type','=','tranquilo_business_type.b_type_id')
                ->count();

        $data['models_count'] = $model_count;

        if($model_count <> 0){

            $model = Db::table('tranquilo_deal')
                    ->join($model_in,'tranquilo_deal.d_model','=','model.m_id')
                    ->join('tranquilo_business_type','tranquilo_deal.d_b_type','=','tranquilo_business_type.b_type_id')
                    ->join('tranquilo_users','tranquilo_deal.d_owner','=','tranquilo_users.id')
                    ->orderBy('tranquilo_deal.d_date','desc')
                    ->paginate(10);

            $data['models'] = $model;
        }

        return view('admin.dealrecords',$data);

    }
}
