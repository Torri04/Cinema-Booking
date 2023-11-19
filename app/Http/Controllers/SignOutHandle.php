<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class SignOutHandle extends Controller
{
    public function __construct()
    {
    }
    //Get
    public function index()
    {
        if (Cookie::has('isAdmin')) {
            Cookie::queue(Cookie::forget('isAdmin'));
        } else if (Cookie::has('isUser')) {
            Cookie::queue(Cookie::forget('isUser'));
        } else return abort(404);
        return redirect(route("home"));
    }
}
