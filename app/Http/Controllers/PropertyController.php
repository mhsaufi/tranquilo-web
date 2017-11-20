<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as Db;
use Carbon\Carbon;

class PropertyController extends Controller
{
    public function uploadGalleries(Request $request){

    	$files = $request->file('file');
        $img_key = $request->input('model_key');
        $now = Carbon::now();

        $long_file_name = '';
        $i = 0;

        foreach($files as $file)
        {
            $file_name = $file->getClientOriginalName();

            if($i <> 0)
            {
                $long_file_name .= '|';
            }

            $long_file_name .= $file_name;

            $i++;
        }

        $result = Db::table('tranquilo_model')->where('m_gallery_key',$img_key)->count();

        if($result <> 0)
        {
            $data = Db::table('tranquilo_model')->where('m_gallery_key',$img_key)->first();

            $img = $data->img;
            $new_img = $img."|".$long_file_name;
            $id = $data->m_id;

            Db::table('tranquilo_model')->where('m_id',$id)->update(['m_gallery'=>$new_img]);

        }
        else
        {
            $id = Db::table('tranquilo_model')->insertGetId(['m_gallery'=>$long_file_name,'m_gallery_key'=>$img_key]); 
        }

        foreach($files as $file)
        {
            $file_name = $file->getClientOriginalName();

            $file_store = $file->storeAs('galleries/'.$id,$file_name); // Store File

        }

        return $img_key;
    }

    public function checkOutDeal(Request $request){

    	$title = $request->input('title');
    	$year = $request->input('year');
    	$m_type = $request->input('m_type');
    	$m_price = $request->input('m_price');
    	$b_type = $request->input('b_type');
    	$deal = $request->input('deal');
    	$address = $request->input('address');
    	$keygen = $request->input('keygen');
    	$state = $request->input('state');
    	$now = Carbon::now();

    	if($request->input('description')){
    		$description = $request->input('description');
    	}else{
    		$description = "";
    	}

    	if($request->input('description_html')){
    		$description_html = $request->input('description_html');
    	}else{
    		$description_html = "";
    	}

    	$via_gallery = Db::table('tranquilo_model')->where('m_gallery_key',$keygen)->first();
    	$model_id = $via_gallery->m_id;

    	Db::table('tranquilo_model')->where('m_id',$model_id)->update([
    															'm_title'=>$title,
    															'm_year'=>$year,
    															'm_price'=>$m_price,
    															'm_b_type'=>$b_type,
    															'm_h_type'=>$m_type,
    															'm_owner'=>Auth::id(),
    															'm_description'=>$description,
    															'm_description_html'=>$description_html,
    															'm_state'=>$state,
    															'm_address'=>$address
    														]);

    	Db::table('tranquilo_deal')->insert([
    											'd_owner'=>Auth::id(),
    											'd_b_type'=>$b_type,
    											'd_model'=>$model_id,
    											'd_value'=>$deal,
    											'd_status'=>1,
    											'd_date'=>$now
    										]);
    }

    public function viewProperty(Request $request){

        $model_id = $request->input('m');

        if(Auth::user()->role == 3){

            $model = Db::table('tranquilo_model')
                    ->where('m_id',$model_id)
                    ->join('tranquilo_users','tranquilo_model.m_owner','=','tranquilo_users.id')
                    ->join('tranquilo_deal','tranquilo_model.m_id','=','tranquilo_deal.d_model')
                    ->join('tranquilo_state','tranquilo_model.m_state','=','tranquilo_state.state_id')
                    ->join('tranquilo_house_type','tranquilo_model.m_h_type','=','tranquilo_house_type.h_type_id')
                    ->join('tranquilo_business_type','tranquilo_model.m_b_type','=','tranquilo_business_type.b_type_id')
                    ->first();

            $created = Carbon::parse($model->d_date);
            $model->d_date = $created->toFormattedDateString();

            $data['model'] = $model;

            return view ('client.viewproperty',$data);

        }else{

            $model = Db::table('tranquilo_model')
                    ->where('m_id',$model_id)
                    ->join('tranquilo_users','tranquilo_model.m_owner','=','tranquilo_users.id')
                    ->join('tranquilo_deal','tranquilo_model.m_id','=','tranquilo_deal.d_model')
                    ->join('tranquilo_state','tranquilo_model.m_state','=','tranquilo_state.state_id')
                    ->join('tranquilo_house_type','tranquilo_model.m_h_type','=','tranquilo_house_type.h_type_id')
                    ->join('tranquilo_business_type','tranquilo_model.m_b_type','=','tranquilo_business_type.b_type_id')
                    ->first();

            $created = Carbon::parse($model->d_date);
            $model->d_date = $created->toFormattedDateString();

            $data['model'] = $model;

            return view ('landlord.viewproperty',$data);

        }
    }
}
