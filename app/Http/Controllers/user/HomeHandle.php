<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeHandle extends Controller
{
    public function __construct()
    {
    }
    //GET
    public function index()
    {
        $movies = DB::select("SELECT * FROM Movie WHERE IsOnShow = ?", [1]);

        $shows = DB::table("Show")
            ->select('*')
            ->orderBy('StartTime', 'ASC')
            ->get();

        $otherProm = DB::table("Promotion")
            ->select('*')
            ->get();

        return view("client/home", compact("movies", "shows", "otherProm"));
    }
}
