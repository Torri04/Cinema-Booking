<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ComingFilmInfoHandle extends Controller
{    public function __construct()
    {}
    //GET
    public function index(Request $request)
    {
        //Thông tin phim
        $name = $request->Name;

        $movie = DB::select("SELECT * FROM Movie WHERE Name = ?",[$name]);

        return view("client/infoComingFilm", compact('movie'));
    }
}
