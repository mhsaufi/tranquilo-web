<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */

    public function authenticate(Request $request)
    {
    	$email = $request->input('email');
    	$password = $request->input('password');

        if (Auth::attempt(['email' => $email, 'password' => $password, 'role'=>1])) {
            // Authentication passed...

            // echo "YOU ARE AUTHENTICATED NOW YOU ARE LOGGED IN INTO THE SYSTEM";+
            return redirect()->intended('dashboard');

        }else{

            $message = "Wrong credential";

            $data['message'] = $message;

            return view('admin.authadmin.login',$data);
        }
    }
}
