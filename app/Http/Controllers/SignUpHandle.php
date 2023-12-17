<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class SignUpHandle extends Controller
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
        else return view("pages/signUp");
    }
    //Post
    public function SignUpHandle(Request $request)
    {
        DB::table('User')->insert([
            "UserID" => Uuid::uuid4()->toString(),
            "User" => $request->user,
            'Name' => $request->userName,
            'Email' => $request->mail,
            'Phone' => $request->tele,
            'Password' => $request->pass,
        ]);
        return redirect(route("signin"))->with('user', $request->user);
    }
}
