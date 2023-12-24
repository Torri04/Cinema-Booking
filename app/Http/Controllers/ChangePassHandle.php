<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class ChangePassHandle extends Controller
{
    public function __construct()
    {
    }
    //Get
    public function index()
    {
        return view("pages/changePass");
    }
    //Post
    public function changePass(Request $request)
    {
        if (Cookie::has("isAdmin")) {
            $userCk = Cookie::get('isAdmin');
            $userCk = json_decode($userCk);

            DB::table('User')
                ->where('UserID', $userCk->userID)
                ->update(['Password' => $request->newpass]);

            return redirect(route("adminAccount"));
        } else {
            $userCk = Cookie::get('isUser');
            $userCk = json_decode($userCk);

            DB::table('User')
                ->where('UserID', $userCk->userID)
                ->update(['Password' => $request->newpass]);

            return redirect(route("userAccount"));
        }
    }
}
