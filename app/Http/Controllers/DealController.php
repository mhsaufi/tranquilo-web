<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PropertyController as Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as Db;
use Carbon\Carbon;

class DealController extends Controller
{
    public function viewDeal(){

    	$query =  "
        SELECT * FROM tranquilo_model 
        INNER JOIN tranquilo_state ON tranquilo_model.m_state = tranquilo_state.state_id 
        INNER JOIN tranquilo_house_type ON tranquilo_model.m_h_type = tranquilo_house_type.h_type_id 
        INNER JOIN tranquilo_business_type ON tranquilo_model.m_b_type = tranquilo_business_type.b_type_id";

        $model_in = Db::raw('('.$query.') as model');

        $model = Db::table('tranquilo_deal')
                ->join($model_in,'tranquilo_deal.d_model','=','model.m_id')
                ->orderBy('tranquilo_deal.d_date','desc')
                ->paginate(4);

	    $data['models'] = $model;

    	return view('landlord.dealview',$data);
    }

    public function viewSingleDeal(Request $request){

    	$model_id = $request->input('m');

    	$model = Db::table('tranquilo_model')
                    ->where('m_id',$model_id)
                    ->join('tranquilo_users','tranquilo_model.m_owner','=','tranquilo_users.id')
                    ->join('tranquilo_deal','tranquilo_model.m_id','=','tranquilo_deal.d_model')
                    ->join('tranquilo_state','tranquilo_model.m_state','=','tranquilo_state.state_id')
                    ->join('tranquilo_house_type','tranquilo_model.m_h_type','=','tranquilo_house_type.h_type_id')
                    ->join('tranquilo_business_type','tranquilo_model.m_b_type','=','tranquilo_business_type.b_type_id')
                    ->first();

        // checked rated

        $rate_record = Db::table('tranquilo_rating')->where('user_id',Auth::id())->first();
        $rate_record_count = Db::table('tranquilo_rating')->where('user_id',Auth::id())->count();

        if($rate_record_count <> 0){

            $arr_rated_model = explode("|", $rate_record->rated_model);
            $arr_rated_value = explode("|", $rate_record->avg_rated);

            if(in_array($model_id,$arr_rated_model)){

                $pos = array_search($model_id,$arr_rated_model);

                $data['model_rated'] = true;
                $data['rated_value'] = $arr_rated_value[$pos];

            }else{

                $data['model_rated'] = false;

            }
        }else{

            $data['model_rated'] = false;

        }
        

        $created = Carbon::parse($model->d_date);
        $model->d_date = $created->toFormattedDateString();

        $property = new Property;
        $property->updateView($model_id,$model->m_view);

        $data['model'] = $model;

        return view ('landlord.viewsingledeal',$data);
    }

    public function newDeal(){

        $h_type = Db::table('tranquilo_house_type')->orderBy('h_type_title')->get();
        $b_type = Db::table('tranquilo_business_type')->orderBy('b_type_title')->get();
        $state = Db::table('tranquilo_state')->orderBy('state_title')->get();
        $model = Db::table('tranquilo_model')
                ->select('tranquilo_model.m_title','tranquilo_model.m_id','tranquilo_house_type.h_type_title')
                ->join('tranquilo_house_type','tranquilo_model.m_h_type','=','tranquilo_house_type.h_type_id')
                ->where('tranquilo_model.m_owner',Auth::id())
                ->orderBy('tranquilo_model.m_title')
                ->get();

        $data['h_type'] = $h_type;
        $data['b_type'] = $b_type;
        $data['state'] = $state;
        $data['model'] = $model;

        return view('landlord.addnewdealform',$data);
    }

    public function addNewDeal(Request $request){

        $b_type = $request->input('b_type');
        $contact = $request->input('contact');
        $deal = $request->input('deal');
        $m_id = $request->input('model');
        $now = Carbon::now();

        if($request->input('description') <> ''){
            $description = $request->input('description');
        }

        if($request->input('description_html') <> ''){
            $description = $request->input('description_html');
        }

        $model = Db::table('tranquilo_model')->where('m_id',$m_id)->first();

        Db::table('tranquilo_deal')->insert([
                                                'd_owner'=>Auth::id(),
                                                'd_description'=>$description,
                                                'd_contact'=>$contact,
                                                'd_b_type'=>$b_type,
                                                'd_model'=>$m_id,
                                                'd_value'=>$deal,
                                                'd_status'=>1,
                                                'd_date'=>$now
                                            ]);
    }
}
