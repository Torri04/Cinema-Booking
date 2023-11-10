<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberHandle extends Controller
{    public function __construct()
    {}
    //GET
    public function index()
    {
        return view("client/member");
    }
}
