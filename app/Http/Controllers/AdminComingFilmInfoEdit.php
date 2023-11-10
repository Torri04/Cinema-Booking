<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AdminComingFilmInfoEdit extends Controller
{
    public function __construct()
    {}
    //GET
    public function index(Request $request)
    {
        //Thông tin phim
        $name = $request->Name;

        $movie = DB::select("SELECT * FROM Movie WHERE Name = ?",[$name]);

        return view("admin/infoComingFilmAdminEdit", compact('movie'));
    }
    
    public function infoEdit(Request $request)
    {
        $show = "on";
        if($request->has("show"))
        {
            $show = 1;
        }
        else $show = 0;

        $movieID = $request->MovieID;

        //Get Film Info
        $movie = DB::select("SELECT * FROM Movie WHERE MovieID = ?",[$movieID]);
        
        //Handle background
        if($request->hasFile("insertIMG"))
        {
            //delete background
            $OldIMG = $movie[0]->Background;
            Storage::delete('public/img/movies/'.$OldIMG);

            //Add new background
            $insertIMG = $request->file('insertIMG');
            $insertIMG_name = "img_".uniqid().".".$insertIMG->extension();
            Storage::putFileAs("public/img/movies", $insertIMG, $insertIMG_name); 

            //Update
            DB::table('Movie')
            ->where('MovieID', $movieID)
            ->update(['Background' => $insertIMG_name]);
        }

        //Handle poster
        if($request->hasFile("insertPoster"))
        {
            //delete Poster
            $OldPoster = $movie[0]->Poster;
            Storage::delete('public/img/posters/'.$OldPoster);

            //Add new Poster
            $insertPoster = $request->file('insertPoster');
            $insertPoster_name = "img_".uniqid().".".$insertPoster->extension();
            Storage::putFileAs("public/img/posters", $insertPoster, $insertPoster_name); 

            //Update
            DB::table('Movie')
            ->where('MovieID', $movieID)
            ->update(['Poster' => $insertPoster_name]);
        }

        //Update the tables
        DB::table('Movie')
        ->where('MovieID', $movieID)
        ->update([
            'Name' => $request->Name,
            'Genres' => $request->Genres,
            'Duration' => Carbon::createFromFormat('H:i:s', str_replace("m","",str_replace('h ',':',$request->Dur)) .':00')->format('H:i:s'),
            'Language' => $request->Lan,
            'ReleaseDate' => Carbon::createFromFormat('d-m-Y', str_replace('/','-',$request->Date))->format('Y-m-d'),
            'Director' => $request->Direc,
            'Actors' => $request->Actor,
            'Content' => $request->Content,
            'Link' => $request->trailer,
            'IsOnShow' => $show,
            'IsReleased' => $show,
        ]);

        return redirect(route('adminFilm',["Film" => "coming"]));
    }
}

