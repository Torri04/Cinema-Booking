<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class ForgetHandle extends Controller
{
    public function __construct()
    {
    }
    //Get
    public function index()
    {
        return view("pages/forget");
    }
    //Post
    public function ForgetHandle(Request $request)
    {
    }
}
