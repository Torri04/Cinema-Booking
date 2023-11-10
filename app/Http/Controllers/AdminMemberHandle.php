<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminMemberHandle extends Controller
{    public function __construct()
    {}
    //GET
    public function index()
    {
        return view("admin/memberAdmin");
    }
}
