<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminHomeHandle extends Controller
{
    public function __construct()
    {
    }
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

        return view("admin/homeAdmin", compact("movies", "shows", "otherProm"));
    }
    public function deleteFilm(Request $request)
    {
        DB::table('Movie')
            ->where('MovieID', $request->mvID)
            ->update(['IsOnShow' => 0]);

        return redirect(route('adminHome'));
    }
}
