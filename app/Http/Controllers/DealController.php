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
        INNER JOIN tranquilo_house_type ON tranquilo_model.m_h_type = tranquilo_house_type.h_type_id";

        $model_in = Db::raw('('.$query.') as model');

        $model = Db::table('tranquilo_deal')
                ->join($model_in,'tranquilo_deal.d_model','=','model.m_id')
                ->join('tranquilo_business_type','tranquilo_deal.d_b_type','=','tranquilo_business_type.b_type_id')
                ->orderBy('tranquilo_deal.d_date','desc')
                ->paginate(10);

        $model_count = Db::table('tranquilo_deal')
                ->join($model_in,'tranquilo_deal.d_model','=','model.m_id')
                ->join('tranquilo_business_type','tranquilo_deal.d_b_type','=','tranquilo_business_type.b_type_id')
                ->count();

	    $data['models'] = $model;
        $data['models_count'] = $model_count;

    	return view('landlord.dealview',$data);
    }

    public function viewSingleDeal(Request $request){

    	$deal_id = $request->input('m');

        $query =  "
        SELECT * FROM tranquilo_model 
        INNER JOIN tranquilo_state ON tranquilo_model.m_state = tranquilo_state.state_id 
        INNER JOIN tranquilo_house_type ON tranquilo_model.m_h_type = tranquilo_house_type.h_type_id";

        $model_in = Db::raw('('.$query.') as model');

        $query_model = Db::table('tranquilo_deal')
                ->join($model_in,'tranquilo_deal.d_model','=','model.m_id')
                ->join('tranquilo_users','tranquilo_deal.d_owner','=','tranquilo_users.id')
                ->join('tranquilo_business_type','tranquilo_deal.d_b_type','=','tranquilo_business_type.b_type_id')
                ->where('tranquilo_deal.d_id',$deal_id);

        $model = $query_model->first();

        $created = Carbon::parse($model->d_date);
        $model->d_date = $created->toFormattedDateString();

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

        $property = new Property;
        $property->updateView($model->m_id,$model->m_view);

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

    public function addReview(Request $request){

        $content = $request->input('content');
        $user = $request->input('user');
        $deal = $request->input('deal');

        $new_review = Db::table('tranquilo_review')->insertGetId(['review_content'=>$content,'user_id'=>$user,'deal_id'=>$deal,'review_status'=>2]);

        $review = Db::table('tranquilo_review')
                ->join('tranquilo_users','tranquilo_review.user_id','=','tranquilo_users.id')
                ->where('tranquilo_review.review_id',$new_review)
                ->first();

        $created = Carbon::parse($review->review_date);
        $review->review_date = $created->toFormattedDateString();

        return json_encode($review);
    }

    public function landlordFeed(Request $request){

        $query =  "
        SELECT * FROM tranquilo_model 
        INNER JOIN tranquilo_state ON tranquilo_model.m_state = tranquilo_state.state_id 
        INNER JOIN tranquilo_house_type ON tranquilo_model.m_h_type = tranquilo_house_type.h_type_id";

        $model_in = Db::raw('('.$query.') as model');

        $query_model = Db::table('tranquilo_deal')
                ->join('tranquilo_business_type','tranquilo_deal.d_b_type','=','tranquilo_business_type.b_type_id')
                ->join($model_in,'tranquilo_deal.d_model','=','model.m_id');

        $cond_from = '';
        $cond_to = '';

        if($request->input('from') && $request->input('to')){

            $query_model->whereBetween('tranquilo_deal.d_value', array($request->input('from'), $request->input('to')));

            $cond_from = $request->input('from');
            $cond_to = $request->input('to');
        }

        $cond_state = '';

        if($request->input('state')){
            if($request->input('state') <> 0){
                $query_model->where('model.m_state',$request->input('state'));
            }

            $cond_state = $request->input('state');
        }

        $cond_h_type = '';

        if($request->input('h_type')){
            $query_model->where('model.m_h_type',$request->input('h_type'));
            $cond_h_type = $request->input('h_type');
        }

        $sort_rate = '';

        if($request->input('rate_sort')){
            if($request->input('rate_sort') == 'asc'){
                $query_model->orderBy('model.m_rate_value','asc');
                $sort_rate = $request->input('rate_sort');
            }
            if($request->input('rate_sort') == 'desc'){
                $query_model->orderBy('model.m_rate_value','desc');
                $sort_rate = $request->input('rate_sort');
            }
        }

        $sort_price = '';

        if($request->input('price_sort')){
            if($request->input('price_sort') == 'asc'){
                $query_model->orderBy('tranquilo_deal.d_value','asc');
                $sort_price = $request->input('price_sort');
            }
            if($request->input('price_sort') == 'desc'){
                $query_model->orderBy('tranquilo_deal.d_value','desc');
                $sort_price = $request->input('price_sort');
            }
        }

        $sort_view = '';

        if($request->input('view_sort')){
            if($request->input('view_sort') == 'asc'){
                $query_model->orderBy('model.m_view','asc');
            }
            if($request->input('view_sort') == 'desc'){
                $query_model->orderBy('model.m_view','desc');
            }

            $sort_view = $request->input('view_sort');
        }

        $sort_date = '';

        if($request->input('date_sort')){
            if($request->input('date_sort') == 'asc'){
                $query_model->orderBy('tranquilo_deal.d_date','asc');
            }
            if($request->input('date_sort') == 'desc'){
                $query_model->latest('tranquilo_deal.d_date');
            }

            $sort_date = $request->input('date_sort');
        }

        $model = $query_model->paginate(7);

        if($request->input('model_count')){

            $model_count = $request->input('model_count');

        }else{

            $model_count = $query_model->count();

        }

        $state = Db::table('tranquilo_state')->orderBy('state_title')->get();
        $h_type = Db::table('tranquilo_house_type')->orderBy('h_type_title')->get();

        $bookmark_count = Db::table('tranquilo_bookmark')->where('bookmark_user',Auth::id())->count();

        if($bookmark_count <> 0){

            $bookmark_record = Db::table('tranquilo_bookmark')->where('bookmark_user',Auth::id())->first();
            $bookmarked = explode("|", $bookmark_record->bookmark_deal);
            $data['bookmarked'] = $bookmarked;

        }else{

            $data['bookmarked'] = array(0);

        }

        $data['bookmark_count'] = $bookmark_count;

        $data['model_count'] = $model_count;
        $data['models'] = $model;
        $data['state'] = $state;
        $data['h_type'] = $h_type;

        $data['cond_to'] = $cond_to;
        $data['cond_from'] = $cond_from;
        $data['cond_h_type'] = $cond_h_type;
        $data['cond_state'] = $cond_state;

        $data['sort_date'] = $sort_date;
        $data['sort_price'] = $sort_price;
        $data['sort_rate'] = $sort_rate;
        $data['sort_view'] = $sort_view;

        return view('landlord.feed',$data);
    }

    public function editDeal(Request $request){

        $deal_id = $request->input('d');

        $h_type = Db::table('tranquilo_house_type')->orderBy('h_type_title')->get();
        $b_type = Db::table('tranquilo_business_type')->orderBy('b_type_title')->get();
        $state = Db::table('tranquilo_state')->orderBy('state_title')->get();

        $query =  "
        SELECT * FROM tranquilo_model 
        INNER JOIN tranquilo_state ON tranquilo_model.m_state = tranquilo_state.state_id 
        INNER JOIN tranquilo_house_type ON tranquilo_model.m_h_type = tranquilo_house_type.h_type_id";

        $model_in = Db::raw('('.$query.') as model');

        $query_model = Db::table('tranquilo_deal')
                ->join($model_in,'tranquilo_deal.d_model','=','model.m_id')
                ->join('tranquilo_users','tranquilo_deal.d_owner','=','tranquilo_users.id')
                ->join('tranquilo_business_type','tranquilo_deal.d_b_type','=','tranquilo_business_type.b_type_id')
                ->where('tranquilo_deal.d_id',$deal_id);


        $model = $query_model->first();

        $data['h_type'] = $h_type;
        $data['b_type'] = $b_type;
        $data['state'] = $state;
        $data['model'] = $model;

        return view('landlord.editdealform',$data);
    }

    public function editDealSave(Request $request){

        $b_type = $request->input('b_type');
        $contact = $request->input('contact');
        $deal = $request->input('deal');
        $deal_id = $request->input('deal_id');
        $now = Carbon::now();

        if($request->input('description') <> ''){
            $description = $request->input('description');
        }

        if($request->input('description_html') <> ''){
            $description = $request->input('description_html');
        }

        Db::table('tranquilo_deal')->where('d_id',$deal_id)->update([
                                                'd_description'=>$description,
                                                'd_contact'=>$contact,
                                                'd_b_type'=>$b_type,
                                                'd_value'=>$deal,
                                                'd_status'=>1
                                            ]);
    }

    public function deleteDeal(Request $request){

        $deal_id = $request->input('deal_id');

        Db::table('tranquilo_deal')->where('d_id',$deal_id)->delete();
    }
}
