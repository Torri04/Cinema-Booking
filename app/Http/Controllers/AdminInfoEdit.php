<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AdminInfoEdit extends Controller
{
    public function __construct()
    {}
    //GET
    public function index(Request $request)
    {
        //Thông tin phim
        $name = $request->Name;
        $day = $request->Day;
        $date = Carbon::now();

        if($day == "2ndDay")
        {
            $date = $date->addDays(1);
        }
        if($day == "3rdDay")
        {
            $date = $date->addDays(2);
        }

        $movie = DB::select("SELECT * FROM Movie WHERE Name = ?",[$name]);

        //2D Phụ đề
        $shows_1 = DB::table('Movie')
        ->join('Show', 'Movie.MovieID', '=', 'Show.MovieID')
        ->where('Type', '2D Phụ đề')
        ->where('Name', $name)
        ->whereDay('Show.Date', $date->format("d"))
        ->whereMonth('Show.Date', $date->format("m"))
        ->select('*')
        ->orderBy('StartTime', 'ASC')
        ->get();
        
        //2D Lồng tiếng
        $shows_2 = DB::table('Movie')
        ->join('Show', 'Movie.MovieID', '=', 'Show.MovieID')
        ->where('Type', '2D Lồng tiếng')
        ->where('Name', $name)
        ->whereDay('Show.Date', $date->format("d"))
        ->whereMonth('Show.Date', $date->format("m"))
        ->select('*')
        ->orderBy('StartTime', 'ASC')
        ->get();

        return view("admin/infoAdminEdit", compact('movie', 'shows_1','shows_2'));
    }
    public function infoEdit(Request $request)
    {
        $movieID = $request->MovieID;
        $day = $request->Day;

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
        ]);

        //add show
        $date = Carbon::now();
        if($day == "2ndDay")
        {
            $date = $date->addDays(1);
        }
        else if($day == "3rdDay")
        {
            $date = $date->addDays(2);
        } 
        $date = $date->format("Y-m-d");

        if($request->show_n)
        {
            foreach($request->show_n as $show)
            {
                if($show)
                {    DB::table('Show')->insert([
                    'Date' => $date,
                    'StartTime' => $show.":00",
                    'EndTime' => $show.":00",
                    'MovieID' => $movieID,
                    'Type' => "2D Phụ đề",
                ]);}
            }
        }
        if($request->show_m)
        {
            foreach($request->show_m as $show)
           {
            if($show)
            {
                DB::table('Show')->insert([
                    'Date' => $date,
                    'StartTime' => $show.":00",
                    'EndTime' => $show.":00",
                    'MovieID' => $movieID,
                    'Type' => "2D Lồng tiếng",
                ]);
            }
        }
        }

        if($request->deletedShow)
        {
            foreach($request->deletedShow as $show)
            {
                DB::table('Show')->where('ShowID', '=', $show)->delete();
            }
        }

        return redirect(route('adminInfoEdit',["Name" => $request->Name,"Day" => $day]));
    }
}

