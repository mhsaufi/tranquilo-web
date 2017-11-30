<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as Db;

class APIController extends Controller
{
    public function getModelSingle(Request $request){

    	$m_id = $request->input('m');

    	$model = Db::table('tranquilo_model')
                    ->where('m_id',$m_id)
                    ->join('tranquilo_state','tranquilo_model.m_state','=','tranquilo_state.state_id')
                    ->join('tranquilo_house_type','tranquilo_model.m_h_type','=','tranquilo_house_type.h_type_id')
                    ->first();

        $created = Carbon::parse($model->created_at);
        $model->created_at = $created->toFormattedDateString();

        return json_encode($model);
    }

    public function getModelsList(Request $request){

    	$model = Db::table('tranquilo_model')
                    ->join('tranquilo_state','tranquilo_model.m_state','=','tranquilo_state.state_id')
                    ->join('tranquilo_house_type','tranquilo_model.m_h_type','=','tranquilo_house_type.h_type_id')
                    ->first();

        $created = Carbon::parse($model->created_at);
        $model->created_at = $created->toFormattedDateString();

        return json_encode($model);

    }

    public function getDealSingle(Request $request){

    	$deal_id = $request->input('deal');

        $query =  "
        SELECT * FROM tranquilo_model 
        INNER JOIN tranquilo_state ON tranquilo_model.m_state = tranquilo_state.state_id 
        INNER JOIN tranquilo_house_type ON tranquilo_model.m_h_type = tranquilo_house_type.h_type_id";

        $query_user = "
        SELECT id, name, email, phone_no FROM tranquilo_users";

        $model_in = Db::raw('('.$query.') as model');
        $model_in_user = Db::raw('('.$query_user.') as user');

        $query_model = Db::table('tranquilo_deal')
                ->join($model_in,'tranquilo_deal.d_model','=','model.m_id')
                ->join($model_in_user,'tranquilo_deal.d_owner','=','user.id')
                ->join('tranquilo_business_type','tranquilo_deal.d_b_type','=','tranquilo_business_type.b_type_id')
                ->where('tranquilo_deal.d_id',$deal_id);

        $model = $query_model->first();

        return json_encode($model);
    }

    public function getDealsList(Request $request){

    	$query =  "
        SELECT * FROM tranquilo_model 
        INNER JOIN tranquilo_state ON tranquilo_model.m_state = tranquilo_state.state_id 
        INNER JOIN tranquilo_house_type ON tranquilo_model.m_h_type = tranquilo_house_type.h_type_id";

        $query_user = "
        SELECT id, name, email, phone_no FROM tranquilo_users";

        $model_in = Db::raw('('.$query.') as model');
        $model_in_user = Db::raw('('.$query_user.') as user');

        $query_model = Db::table('tranquilo_deal')
                ->join($model_in,'tranquilo_deal.d_model','=','model.m_id')
                ->join($model_in_user,'tranquilo_deal.d_owner','=','user.id')
                ->join('tranquilo_business_type','tranquilo_deal.d_b_type','=','tranquilo_business_type.b_type_id')
                ->where('tranquilo_deal.d_id',$deal_id);

        $model = $query_model->get();

        return json_encode($model);

    }
}
