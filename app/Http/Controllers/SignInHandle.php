<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class SignInHandle extends Controller
{
    public function __construct()
    {
    }
    //Get
    public function index()
    {
        $isAdmin = Cookie::get('isAdmin');
        $isUser = Cookie::get('isUser');
        if ($isAdmin)
            return redirect(route("adminHome"));
        else if ($isUser)
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

        if (!$user->isEmpty()) {
            if ($user[0]->Admin) {
                $userStorage = ['userID' => $user[0]->UserID, 'user' => $user[0]->User, 'avatar' => $user[0]->Avatar, 'phone' => $user[0]->Phone];
                $array_json = json_encode($userStorage);

                Cookie::queue(Cookie::make('isAdmin', $array_json, 15));
                return redirect(route("adminHome"));
            } else {
                $userStorage = ['userID' => $user[0]->UserID, 'user' => $user[0]->User, 'avatar' => $user[0]->Avatar, 'phone' => $user[0]->Phone];
                $array_json = json_encode($userStorage);

                Cookie::queue(Cookie::make('isUser', $array_json, 15));
                return redirect(route("home"));
            }
        } else {
            return redirect(route("signin"));
        }
    }
}
