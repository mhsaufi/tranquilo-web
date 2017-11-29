<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PropertyController as Property;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $reviews = Db::table('tranquilo_review')
                ->join('tranquilo_users','tranquilo_review.user_id','=','tranquilo_users.id')
                ->where('review_status',2)
                ->latest('review_date')
                ->take(4)
                ->get();

        foreach($reviews as $review){

            $ctd = Carbon::parse($review->review_date);
            $review->review_date = $ctd->toFormattedDateString();

        }

    	$data['state'] = $state;
    	$data['models'] = $model;
        $data['reviews'] = $reviews;

    	return view('welcome',$data);
    }

    public function about(){

        return view('aboutus');
    }

    public function contact(){

        return view('contactus');
    }

    public function property(Request $request){

        if(Auth::check()) {

            return redirect('/home');

        }else{

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

            $cond_state = 0;

            if($request->input('state')){
                if($request->input('state') <> 0){
                    $query_model->where('model.m_state',$request->input('state'));
                }

                $cond_state = $request->input('state');
            }

            $cond_h_type = 0;

            if($request->input('h_type') <> 0){
                $query_model->where('model.m_h_type',$request->input('h_type'));
                $cond_h_type = $request->input('h_type');
            }

            $sort_rate = 'none';

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

            $sort_price = 'none';

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

            $sort_view = 'none';

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

            $model = $query_model->paginate(10);

            if($request->input('model_count')){

                $model_count = $request->input('model_count');

            }else{

                $model_count = $query_model->count();

            }

            $state = Db::table('tranquilo_state')->orderBy('state_title')->get();
            $h_type = Db::table('tranquilo_house_type')->orderBy('h_type_title')->get();

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

            return view('public.property',$data);
        }
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

        $created = Carbon::parse($model->d_date);
        $model->d_date = $created->toFormattedDateString();

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

        $property = new Property;
        $property->updateView($model->m_id,$model->m_view);

        $data['model'] = $model;
        $data['reviews'] = $reviews;

        return view ('public.viewproperty',$data);

    }
}
