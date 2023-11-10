<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AdminInfoAdd extends Controller
{
    public function __construct()
    {}
    public function index(Request $request)
    {
        $film = $request->Film;
        return view("admin/infoAdminAdd",compact('film'));
    }
    //post film
    public function addFilm(Request $request)
    {
        $show = 0;
        if($request->Film == "coming")
            $show = 0;
        else
            $show = 1;

        $insertIMG = $request->file('insertIMG');
        $insertPoster = $request->file('insertPoster');

        $insertIMG_name = "img_".uniqid().".".$insertIMG->extension();
        $insertPoster_name = "img_".uniqid().".".$insertPoster->extension();
        
        Storage::putFileAs("public/img/movies", $insertIMG, $insertIMG_name); 
        Storage::putFileAs("public/img/posters", $insertPoster, $insertPoster_name); 

        DB::table('Movie')->insert([
            'Name' => $request->Name,
            'Genres' => $request->Genres,
            'Duration' => Carbon::createFromFormat('H:i:s', str_replace("m","",str_replace('h ',':',$request->Dur)) .':00')->format('H:i:s'),
            'Language' => $request->Lan,
            'ReleaseDate' => Carbon::createFromFormat('d-m-Y', str_replace('/','-',$request->Date))->format('Y-m-d'),
            'Director' => $request->Direc,
            'Actors' => $request->Actor,
            'Content' => $request->Content,
            'Link' => $request->trailer,
            'Background' => $insertIMG_name,
            'Poster' => $insertPoster_name,
            'IsOnShow' => $show,
            'IsReleased' => $show,
        ]);
        return redirect(route("adminFilm",['Film' => $request->Film]));
    }    
}

