<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPromotionHandle extends Controller
{
    public function __construct()
    {
    }
    //GET
    public function index()
    {
        return view("admin/promotionAdmin");
    }
}
