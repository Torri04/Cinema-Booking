<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminHomeHandle extends Controller
{
    public function __construct()
    {}
    public function index()
    {
        $movies = DB::select("SELECT * FROM Movie WHERE IsOnShow = ?",[1]);

        $shows = DB::table("Show")
        ->select('*')
        ->orderBy('StartTime', 'ASC')
        ->get();

        return view("admin/homeAdmin",compact("movies","shows"));
    }
}
