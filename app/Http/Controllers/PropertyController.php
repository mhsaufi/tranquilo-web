<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as Db;
use Carbon\Carbon;

class PropertyController extends Controller
{
    public function updateView($model_id,$m_view){

        $new_view = $m_view + 1;

        Db::table('tranquilo_model')->where('m_id',$model_id)->update(['m_view'=>$new_view]);

    }

    public function updateRating($model_id){

        $all_rating = Db::table('tranquilo_rating')->get();
        $all_rating_count = Db::table('tranquilo_rating')->count();

        $total_rate = 0;
        $total_rate_by = 0;

        if($all_rating_count <> 0){


            foreach($all_rating as $rating){

            $arr_rated_model = explode("|", $rating->rated_model);
            $arr_rated_value = explode("|", $rating->avg_rated);

                if(in_array($model_id,$arr_rated_model)){

                    $pos = array_search($model_id,$arr_rated_model);
                    $rate_value = $arr_rated_value[$pos];
                    $total_rate += $rate_value;
                    $total_rate_by++;
                }
            }

        }

        $latest_rating = $total_rate/$total_rate_by;

        Db::table('tranquilo_model')->where('m_id',$model_id)->update(['m_rate_value'=>$latest_rating,'m_rate_by'=>$total_rate_by]);
    }

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

            $img = $data->m_gallery;
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

    public function uploadGalleriesEdit(Request $request){

        $files = $request->file('file');
        $m_id = $request->input('model');

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

        $data = Db::table('tranquilo_model')->where('m_id',$m_id)->first();
        
        $img = $data->m_gallery;
        $new_img = $img."|".$long_file_name;
        $id = $data->m_id;

        Db::table('tranquilo_model')->where('m_id',$id)->update(['m_gallery'=>$new_img]);

        foreach($files as $file)
        {
            $file_name = $file->getClientOriginalName();

            $file_store = $file->storeAs('galleries/'.$m_id,$file_name); // Store File

        }
    }

    public function updateProperty(Request $request){

        $title = $request->input('title');
        $year = $request->input('year');
        $m_type = $request->input('m_type');
        $m_price = $request->input('m_price');
        $address = $request->input('address');
        $m_id = $request->input('m_id');
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

        Db::table('tranquilo_model')->where('m_id',$m_id)->update([
                                                                'm_title'=>$title,
                                                                'm_year'=>$year,
                                                                'm_price'=>$m_price,
                                                                'm_h_type'=>$m_type,
                                                                'm_description'=>$description,
                                                                'm_description_html'=>$description_html,
                                                                'm_state'=>$state,
                                                                'm_address'=>$address
                                                            ]);
    }

    public function checkOutDeal(Request $request){

    	$title = $request->input('title');
    	$year = $request->input('year');
    	$m_type = $request->input('m_type');
    	$m_price = $request->input('m_price');
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
    															'm_h_type'=>$m_type,
    															'm_owner'=>Auth::id(),
    															'm_description'=>$description,
    															'm_description_html'=>$description_html,
    															'm_state'=>$state,
    															'm_address'=>$address
    														]);
    }

    public function viewProperty(Request $request){

        $deal_id = $request->input('m');

        $query =  "
        SELECT * FROM tranquilo_model 
        INNER JOIN tranquilo_state ON tranquilo_model.m_state = tranquilo_state.state_id 
        INNER JOIN tranquilo_house_type ON tranquilo_model.m_h_type = tranquilo_house_type.h_type_id";

        $model_in = Db::raw('('.$query.') as model');

        $model = Db::table('tranquilo_deal')
                ->join($model_in,'tranquilo_deal.d_model','=','model.m_id')
                ->join('tranquilo_business_type','tranquilo_deal.d_b_type','=','tranquilo_business_type.b_type_id')
                ->join('tranquilo_users','tranquilo_deal.d_owner','=','tranquilo_users.id')
                ->where('tranquilo_deal.d_id',$deal_id)
                ->first();


            $reviews_count = Db::table('tranquilo_review')
                ->where('deal_id',$model->d_id)
                ->where('review_status',2)
                ->count();

            if($reviews_count <> 0){

                $reviews = Db::table('tranquilo_review')
                    ->join('tranquilo_users','tranquilo_review.user_id','=','tranquilo_users.id')
                    ->where('deal_id',$model->d_id)
                    ->where('review_status',2)
                    ->latest('review_date')
                    ->get();


                $data['reviews'] = $reviews;

                foreach($reviews as $review){

                    $ctd = Carbon::parse($review->review_date);
                    $review->review_date = $ctd->toFormattedDateString();

                }

            }
            

            // checked rated

            $rate_record = Db::table('tranquilo_rating')->where('user_id',Auth::id())->first();
            $rate_record_count = Db::table('tranquilo_rating')->where('user_id',Auth::id())->count();

            if($rate_record_count <> 0){

                $arr_rated_model = explode("|", $rate_record->rated_model);
                $arr_rated_value = explode("|", $rate_record->avg_rated);

                if(in_array($model->m_id,$arr_rated_model)){

                    $pos = array_search($model->m_id,$arr_rated_model);

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

            $this->updateView($model->m_id,$model->m_view);

            $data['model'] = $model;
            $data['reviews_count'] = $reviews_count;

            return view ('client.viewproperty',$data);
    }

    public function viewModel(Request $request){

        $model_id = $request->input('m');

        $model = Db::table('tranquilo_model')
                    ->where('m_id',$model_id)
                    ->join('tranquilo_users','tranquilo_model.m_owner','=','tranquilo_users.id')
                    ->join('tranquilo_state','tranquilo_model.m_state','=','tranquilo_state.state_id')
                    ->join('tranquilo_house_type','tranquilo_model.m_h_type','=','tranquilo_house_type.h_type_id')
                    ->first();

        $created = Carbon::parse($model->created_at);
        $model->created_at = $created->toFormattedDateString();

        // $this->updateView($model_id,$model->m_view);

        $data['model'] = $model;

        return view ('landlord.viewproperty',$data);

    }

    public function editProperty(Request $request){

        $m_id = $request->input('m');

         $model = Db::table('tranquilo_model')
                    ->where('m_id',$m_id)
                    ->join('tranquilo_users','tranquilo_model.m_owner','=','tranquilo_users.id')
                    ->join('tranquilo_state','tranquilo_model.m_state','=','tranquilo_state.state_id')
                    ->join('tranquilo_house_type','tranquilo_model.m_h_type','=','tranquilo_house_type.h_type_id')
                    ->first();

        $h_type = Db::table('tranquilo_house_type')->orderBy('h_type_title')->get();

        $state = Db::table('tranquilo_state')->orderBy('state_title')->get();

        $created = Carbon::parse($model->created_at);
        $model->created_at = $created->toFormattedDateString();

        $data['model'] = $model;
        $data['h_type'] = $h_type;
        $data['state'] = $state;

        return view('landlord.editpropertyform',$data);
    }

    public function rateProperty(Request $request){

        $rate_value = $request->input('rate');
        $rate_user = $request->input('user');
        $rate_model = $request->input('model');

        $rate_exist = Db::table('tranquilo_rating')->where('user_id',$rate_user)->count();

        if($rate_exist <> 0){

            $rate_record = Db::table('tranquilo_rating')->where('user_id',$rate_user)->first();

            $model_string = $rate_record->rated_model;
            $old_rate_value = $rate_record->avg_rated;

            $arr_rated_model = explode("|",$model_string);

            if(!in_array($rate_model,$arr_rated_model)){

                $new_model_string = $model_string."|".$rate_model;
                $new_rate_value = $old_rate_value."|".$rate_value;

                Db::table('tranquilo_rating')->where('user_id',$rate_user)->update(['rated_model'=>$new_model_string,'avg_rated'=>$new_rate_value]);

                $this->updateRating($rate_model);
            }

        }else{

            Db::table('tranquilo_rating')->insert(['user_id'=>$rate_user,'rated_model'=>$rate_model,'avg_rated'=>$rate_value]);
        }
    }

    public function bookmarkDeal(Request $request){

        $deal_id = $request->input('deal');
        $user_id = Auth::id();

        // check bookmark
        $bookmark_count = Db::table('tranquilo_bookmark')->where('bookmark_user',$user_id)->count();

        if($bookmark_count <> 0){

            $bookmark_record = Db::table('tranquilo_bookmark')->where('bookmark_user',$user_id)->first();

            $new_bookmark_deal = $bookmark_record->bookmark_deal."|".$deal_id;

            Db::table('tranquilo_bookmark')->where('bookmark_user',$user_id)->update(['bookmark_deal'=>$new_bookmark_deal]);

        }else{

            Db::table('tranquilo_bookmark')->insert(['bookmark_user'=>$user_id,'bookmark_deal'=>$deal_id]);

        }
    }

    public function viewPropertyLandlord(Request $request){

        $deal_id = $request->input('m');

        $query =  "
        SELECT * FROM tranquilo_model 
        INNER JOIN tranquilo_state ON tranquilo_model.m_state = tranquilo_state.state_id 
        INNER JOIN tranquilo_house_type ON tranquilo_model.m_h_type = tranquilo_house_type.h_type_id";

        $model_in = Db::raw('('.$query.') as model');

        $model = Db::table('tranquilo_deal')
                ->join($model_in,'tranquilo_deal.d_model','=','model.m_id')
                ->join('tranquilo_business_type','tranquilo_deal.d_b_type','=','tranquilo_business_type.b_type_id')
                ->join('tranquilo_users','tranquilo_deal.d_owner','=','tranquilo_users.id')
                ->where('tranquilo_deal.d_id',$deal_id)
                ->first();

        $reviews = Db::table('tranquilo_review')
            ->join('tranquilo_users','tranquilo_review.user_id','=','tranquilo_users.id')
            ->where('deal_id',$model->d_id)
            ->where('review_status',2)
            ->latest('review_date')
            ->get();

        foreach($reviews as $review){

            $ctd = Carbon::parse($review->review_date);
            $review->review_date = $ctd->toFormattedDateString();

        }

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

        $this->updateView($model->m_id,$model->m_view);

        $data['model'] = $model;
        $data['reviews'] = $reviews;

        return view ('landlord.landlordviewproperty',$data);

    }

}
