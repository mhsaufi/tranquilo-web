<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as Db;

class ApplicationController extends Controller
{
    public function index(){

        $application_count = Db::table('tranquilo_application')->where('application_client',Auth::id())->count();

        if($application_count <> 0){

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
                            ->latest('tranquilo_application.application_date')
                            ->where('application_client',Auth::id())
                            ->get();

            $data['application_count'] = $application_count;
            $data['application'] = $application;

        }else{

            $data['application_count'] = $application_count;

        }

        // print_r($application);

        return view('client.applicationc',$data);
    }

    public function applyProperty(Request $request){

        $d_id = $request->input('d');

        $deal = Db::table('tranquilo_deal')
                    ->where('d_id',$d_id)
                    ->join('tranquilo_users','tranquilo_deal.d_owner','=','tranquilo_users.id')
                    ->join('tranquilo_model','tranquilo_deal.d_model','=','tranquilo_model.m_id')
                    ->join('tranquilo_business_type','tranquilo_deal.d_b_type','=','tranquilo_business_type.b_type_id')
                    ->first();

        $data['deal'] = $deal;

        return view('client.applyproperty',$data);
    }

    public function apply(Request $request){

    	$installment = $request->input('installment');
    	$remark = $request->input('remark');
    	$d_id = $request->input('d_id');
    	$client = Auth::id();

    	Db::table('tranquilo_application')->insert(['application_deal'=>$d_id,
    												'application_installment'=>$installment,
    												'application_description'=>$remark,
    												'application_client'=>$client	
    												]);

    	return redirect('/home');
    }

    public function boardLandlord(){

        $my_deal_count = Db::table('tranquilo_deal')->where('d_owner',Auth::id())->count();

        if($my_deal_count <> 0){

            $my_deal_arr = array();

            $my_deal = Db::table('tranquilo_deal')->where('d_owner',Auth::id())->get();

            $a = 0;

            foreach($my_deal as $deal){

                $my_deal_arr[$a] = $deal->d_id;

                $a++;
            }

            $application_count = Db::table('tranquilo_application')->whereIn('application_deal',$my_deal_arr)->count();

            if($application_count <> 0){

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
                                ->latest('tranquilo_application.application_date')
                                ->whereIn('application_deal',$my_deal_arr)
                                ->get();

                $data['application_count'] = $application_count;
                $data['application'] = $application;

            }else{

                $data['application_count'] = $application_count;

            }

        }else{
            
            $data['application_count'] = 0;
        }
        
        return view('landlord.board',$data);
    }

    public function viewApplication(Request $request){

        $app_id = $request->input('app_id');

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

        $data['application'] = $application;

        return view('landlord.applicationview',$data);
    }
}
