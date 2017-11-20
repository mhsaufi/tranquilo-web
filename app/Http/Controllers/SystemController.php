<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as Db;

class SystemController extends Controller
{
    public function invalidate(Request $request){

    	Db::table('tranquilo_users')->where('id',Auth::id())->update(['remember_token'=>'']);

    	$request->session()->flush();
        return redirect('/');
    }
}
