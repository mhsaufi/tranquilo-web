<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as Db;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == 3){

            $model = Db::table('tranquilo_model')
                ->join('tranquilo_deal','tranquilo_model.m_id','=','tranquilo_deal.d_model')
                ->join('tranquilo_state','tranquilo_model.m_state','=','tranquilo_state.state_id')
                ->join('tranquilo_house_type','tranquilo_model.m_h_type','=','tranquilo_house_type.h_type_id')
                ->join('tranquilo_business_type','tranquilo_model.m_b_type','=','tranquilo_business_type.b_type_id')
                ->orderBy('tranquilo_deal.d_date','desc')
                ->paginate(3);

            $state = Db::table('tranquilo_state')->orderBy('state_title')->get();
            $h_type = Db::table('tranquilo_house_type')->orderBy('h_type_title')->get();

            $data['models'] = $model;
            $data['state'] = $state;
            $data['h_type'] = $h_type;

            return view('home_client',$data);
        }
        if(Auth::user()->role == 2){

            $model = Db::table('tranquilo_model')
                ->where('m_owner',Auth::id())
                ->join('tranquilo_deal','tranquilo_model.m_id','=','tranquilo_deal.d_model')
                ->join('tranquilo_state','tranquilo_model.m_state','=','tranquilo_state.state_id')
                ->join('tranquilo_house_type','tranquilo_model.m_h_type','=','tranquilo_house_type.h_type_id')
                ->join('tranquilo_business_type','tranquilo_model.m_b_type','=','tranquilo_business_type.b_type_id')
                ->get();

            $data['models'] = $model; 

            return view('home_landlord',$data);
        }
    }

    public function addProperty(){

        $h_type = Db::table('tranquilo_house_type')->orderBy('h_type_title')->get();
        $b_type = Db::table('tranquilo_business_type')->orderBy('b_type_title')->get();
        $state = Db::table('tranquilo_state')->orderBy('state_title')->get();

        $data['h_type'] = $h_type;
        $data['b_type'] = $b_type;
        $data['state'] = $state;

        return view ('landlord.addpropertyform', $data);
    }
}
