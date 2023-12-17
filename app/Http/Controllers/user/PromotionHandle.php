<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PromotionHandle extends Controller
{
    public function __construct()
    {
    }
    //GET
    public function index()
    {
        return view("client/promotion");
    }
}
