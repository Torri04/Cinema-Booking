<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InfoHandle extends Controller
{
    public function __construct()
    {
    }
    //GET
    public function index(Request $request)
    {
        //Thông tin phim
        $name = $request->Name;
        $day = $request->Day;
        $date = Carbon::now();

        if ($day == "2ndDay") {
            $date = $date->addDays(1);
        }
        if ($day == "3rdDay") {
            $date = $date->addDays(2);
        }

        $movie = DB::select("SELECT * FROM Movie WHERE Name = ?", [$name]);

        if ($date->day === Carbon::now()->day) {
            //2D Phụ đề
            $shows_1 = DB::table('Movie')
                ->join('Show', 'Movie.MovieID', '=', 'Show.MovieID')
                ->where('Type', '2D Phụ đề')
                ->where('Name', $name)
                ->where('StartTime', ">=", Carbon::now()->toTimeString())
                ->where('IsShowOn', 1)
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
                ->where('StartTime', ">=", Carbon::now()->toTimeString())
                ->where('IsShowOn', 1)
                ->whereDay('Show.Date', $date->format("d"))
                ->whereMonth('Show.Date', $date->format("m"))
                ->select('*')
                ->orderBy('StartTime', 'ASC')
                ->get();
        } else {
            //2D Phụ đề
            $shows_1 = DB::table('Movie')
                ->join('Show', 'Movie.MovieID', '=', 'Show.MovieID')
                ->where('Type', '2D Phụ đề')
                ->where('Name', $name)
                ->where('IsShowOn', 1)
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
                ->where('IsShowOn', 1)
                ->whereDay('Show.Date', $date->format("d"))
                ->whereMonth('Show.Date', $date->format("m"))
                ->select('*')
                ->orderBy('StartTime', 'ASC')
                ->get();
        }

        return view("client/info", compact('movie', 'shows_1', 'shows_2'));
    }
}
