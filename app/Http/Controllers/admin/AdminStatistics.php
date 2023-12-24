<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AdminStatistics extends Controller
{
    public function __construct()
    {
    }
    public function movieSta(Request $request)
    {
        return view("admin/stat/movieSta");
    }
    public function showSta(Request $request)
    {
        return view("admin/stat/showSta");
    }
    public function userSta(Request $request)
    {
        return view("admin/stat/userSta");
    }
    public function reserSta(Request $request)
    {
        return view("admin/stat/reserSta");
    }
}
