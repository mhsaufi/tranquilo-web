<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as Db;

class ApplicationController extends Controller
{
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
}
