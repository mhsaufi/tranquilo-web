<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as Db;

class SystemController extends Controller
{
    public function invalidate(Request $request){

    	Db::table('tranquilo_users')->where('id',Auth::id())->update(['remember_token'=>'']);

    	$request->session()->flush();
        return redirect('/');
    }

    public function unreadCounter(){

    	$unread_count = Db::table('tranquilo_message')
    					->where('message_recipient',Auth::id())
    					->where('message_status',1)
    					->count();

    	return $unread_count;

    }

    public function getApplication($app_id){

        $query =  "
        SELECT * FROM tranquilo_deal
        INNER JOIN (SELECT * FROM tranquilo_model 
                    INNER JOIN tranquilo_state ON tranquilo_model.m_state = tranquilo_state.state_id 
                    INNER JOIN tranquilo_house_type ON tranquilo_model.m_h_type = tranquilo_house_type.h_type_id 
                    INNER JOIN tranquilo_business_type ON tranquilo_model.m_b_type = tranquilo_business_type.b_type_id) as model
        ON tranquilo_deal.d_model = model.m_id";

        $deal_in = Db::raw('('.$query.') as deal');

        $application = Db::table('tranquilo_application')
                        ->join($deal_in,'tranquilo_application.application_deal','=','deal.d_id')
                        ->join('tranquilo_application_status','tranquilo_application.application_status','=','tranquilo_application_status.application_status_id')
                        ->join('tranquilo_users','tranquilo_application.application_client','=','tranquilo_users.id')
                        ->latest('tranquilo_application.application_date')
                        ->where('tranquilo_application.application_id',$app_id)
                        ->first();

        $t_date = Carbon::parse($application->application_date);
        $application->application_date = $t_date->toFormattedDateString();

        return $application;
    }

    public function getUser($user){

        $user = Db::table('tranquilo_users')->where('id',$user)->first();

        return $user;

    }
}
