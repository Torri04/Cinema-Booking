<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilmHandle extends Controller
{
    public function __construct()
    {
    }
    //GET
    public function index(Request $request)
    {
        $film = $request->Film;

        if ($film == "coming") {
            $movies = DB::select("SELECT * FROM Movie WHERE IsReleased = ?", [0]);
        } else {
            $movies = DB::select("SELECT * FROM Movie WHERE IsOnShow = ?", [1]);
        }

        return view("client/film", compact("movies", "film"));
    }
}
