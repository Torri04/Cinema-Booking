<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminFilmHandle extends Controller
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

        return view("admin/filmAdmin", compact("movies", "film"));
    }
    public function deleteFilm(Request $request)
    {
        if ($request->type == "coming") {
            //Get Film Info
            $movie = DB::select("SELECT * FROM Movie WHERE MovieID = ?", [$request->mvID]);

            //delete Poster
            $OldPoster = $movie[0]->Poster;
            Storage::delete('public/img/posters/' . $OldPoster);

            //delete Background
            $OldBackground = $movie[0]->Background;
            Storage::delete('public/img/movies/' . $OldBackground);

            //Delete Film
            DB::table('Movie')
                ->where('MovieID', $request->mvID)
                ->delete();
        } else {
            DB::table('Movie')
                ->where('MovieID', $request->mvID)
                ->update(['IsOnShow' => 0]);
        }

        return redirect(route('adminFilm', ["Film" => $request->type]));
    }
}
