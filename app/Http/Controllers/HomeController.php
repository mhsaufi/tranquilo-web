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
    public function index(Request $request)
    {
        if(Auth::user()->role == 3){

            $query =  "
            SELECT * FROM tranquilo_model 
            INNER JOIN tranquilo_state ON tranquilo_model.m_state = tranquilo_state.state_id 
            INNER JOIN tranquilo_house_type ON tranquilo_model.m_h_type = tranquilo_house_type.h_type_id";

            $model_in = Db::raw('('.$query.') as model');

            $query_model = Db::table('tranquilo_deal')
                    ->join($model_in,'tranquilo_deal.d_model','=','model.m_id')
                    ->join('tranquilo_business_type','tranquilo_deal.d_b_type','=','tranquilo_business_type.b_type_id');

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

            $model = $query_model->paginate(10);

            if($request->input('model_count')){

                $model_count = $request->input('model_count');

            }else{

                $model_count = $query_model->count();

            }

            $state = Db::table('tranquilo_state')->orderBy('state_title')->get();
            $h_type = Db::table('tranquilo_house_type')->orderBy('h_type_title')->get();

            $bookmark_record = Db::table('tranquilo_bookmark')->where('bookmark_user',Auth::id())->first();

            $bookmarked = explode("|", $bookmark_record->bookmark_deal);

            $data['model_count'] = $model_count;
            $data['bookmarked'] = $bookmarked;
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

            return view('home_client',$data);
        }
        if(Auth::user()->role == 2){

            $model = Db::table('tranquilo_model')
                ->where('m_owner',Auth::id())
                ->join('tranquilo_state','tranquilo_model.m_state','=','tranquilo_state.state_id')
                ->join('tranquilo_house_type','tranquilo_model.m_h_type','=','tranquilo_house_type.h_type_id')
                ->get();

            $data['models'] = $model; 

            return view('home_landlord',$data);
        }
    }

    public function profile(){

        return view('profilepage');
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

    public function myBookmark(){

        $user_id = Auth::id();

        $bookmark_count = Db::table('tranquilo_bookmark')->where('bookmark_user',$user_id)->count();

        if($bookmark_count <> 0){

            $bookmark_info = Db::table('tranquilo_bookmark')->where('bookmark_user',$user_id)->first();

            $arr_bookmark_deal = explode("|",$bookmark_info->bookmark_deal);

            $query =  "
            SELECT * FROM tranquilo_model 
            INNER JOIN tranquilo_state ON tranquilo_model.m_state = tranquilo_state.state_id 
            INNER JOIN tranquilo_house_type ON tranquilo_model.m_h_type = tranquilo_house_type.h_type_id";

            $model_in = Db::raw('('.$query.') as model');

            $deals = Db::table('tranquilo_deal')
                    ->join($model_in,'tranquilo_deal.d_model','=','model.m_id')
                    ->join('tranquilo_business_type','tranquilo_deal.d_b_type','=','tranquilo_business_type.b_type_id')
                    ->whereIn('d_id',$arr_bookmark_deal)
                    ->orderBy('tranquilo_deal.d_date','desc')
                    ->get();

            $data['deals'] = $deals;

            $bookmark_count = sizeof($arr_bookmark_deal);

        }

        $data['bookmark_count'] = $bookmark_count;

        return view('client.bookmarkc', $data);
    }

    public function updateProfile(Request $request){

        $info_updated = '';

        $col = $request->input('col');

        if($col == 'name')
        {
            if($request->input('name') <> ''){

                Db::table('tranquilo_users')->where('id',Auth::id())->update(['name'=>$request->input('name')]);
                $info_updated = $request->input('name');

            }else{

                $info_updated = Auth::user()->name; 
            }
        }

        if($col == 'email')
        {
            if($request->input('email') <> ''){
                
                Db::table('tranquilo_users')->where('id',Auth::id())->update(['email'=>$request->input('email')]);
                $info_updated = $request->input('email');

            }else{

                $info_updated = Auth::user()->email; 
            }
        }

        


        return $info_updated;
    }

    public function listMessages(){

        $message_count = Db::table('tranquilo_message')->where('message_recipient',Auth::id())->count();

        if($message_count <> 0){

            $messages = Db::table('tranquilo_message')
                        ->join('tranquilo_users','tranquilo_message.message_sender','=','tranquilo_users.id')
                        ->where('tranquilo_message.message_recipient',Auth::id())
                        ->latest('tranquilo_message.created_at')
                        ->paginate(6);

            $data['unread_count'] = Db::table('tranquilo_message')
                                    ->where('message_recipient',Auth::id())
                                    ->where('message_status',1)
                                    ->count();

            $data['messages'] = $messages;

        }

        $data['message_count'] = $message_count;

        return view('messages',$data);
    }

    public function readMail(Request $request){

        $mail_id = $request->input('message');

        $mail = Db::table('tranquilo_message')->where('message_id',$mail_id)->first();

        Db::table('tranquilo_message')->where('message_id',$mail_id)->update(['message_status'=>2]);

        $data['mail'] = $mail;

        return view('readmail',$data);

    }
}
