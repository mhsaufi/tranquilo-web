<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as Db;

class PublicController extends Controller
{
    public function index(){

    	$state = Db::table('tranquilo_state')->orderBy('state_title')->get();

    	$model = Db::table('tranquilo_model')
                ->join('tranquilo_deal','tranquilo_model.m_id','=','tranquilo_deal.d_model')
                ->join('tranquilo_state','tranquilo_model.m_state','=','tranquilo_state.state_id')
                ->join('tranquilo_house_type','tranquilo_model.m_h_type','=','tranquilo_house_type.h_type_id')
                ->join('tranquilo_business_type','tranquilo_model.m_b_type','=','tranquilo_business_type.b_type_id')
                ->orderBy('tranquilo_deal.d_value','desc')
                ->paginate(3);

    	$data['state'] = $state;
    	$data['models'] = $model;

    	return view('welcome',$data);
    }
}
