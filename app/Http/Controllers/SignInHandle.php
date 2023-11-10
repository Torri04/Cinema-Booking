<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class SignInHandle extends Controller
{
    public function __construct()
    {}
    //Get
    public function index()
    {
        $isAdmin = Cookie::get('isAdmin');
        $isUser = Cookie::get('isUser');
        if($isAdmin)
           return redirect(route("adminHome"));
        else if($isUser)
           return redirect(route("home"));
        else return view("pages/signIn");
    }
    //Post
    public function SignInHandle(Request $request)
    {
        $user = DB::table('User')
        ->where('User', $request->user)
        ->where('Password', $request->pass)
        ->select('*')
        ->get();    

        if(!$user->isEmpty())
        {
            if($user[0]->Admin)
            {
                Cookie::queue(Cookie::make('isAdmin', $user[0]->UserID, 10));
                return redirect(route("adminHome"));
            }
            else
            {
                Cookie::queue(Cookie::make('isUser', $user[0]->UserID, 10));
                return redirect(route("home"));
            }        
        }
        else
        {
            return redirect(route("signin"));
        }
    }
}
