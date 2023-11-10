<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPromotionHandle extends Controller
{    public function __construct()
    {}
    //GET
    public function index()
    {
        return view("admin/promotionAdmin");
    }
}
