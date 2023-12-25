<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetStatistics extends Controller
{
    public function getMovie(Request $request)
    {
        $movie = DB::table('Movie')
            ->select('*')
            ->get();
        return json_encode($movie);
    }
    public function getShow(Request $request)
    {
        $show = DB::table('Show')
            ->join("Movie", "Show.MovieID", '=', "Movie.MovieID")
            ->select('*')
            ->get();

        return json_encode($show);
    }
    public function getUser(Request $request)
    {
        $user = DB::table('User')
            ->select('*')
            ->get();

        return json_encode($user);
    }
    public function getReser(Request $request)
    {
        $reser = DB::table('User')
            ->rightJoin("Reservation", "Reservation.UserID", '=', "User.UserID")
            ->select('*')
            ->get();

        return json_encode($reser);
    }
    public function getHistory(Request $request)
    {
        $his = DB::table('Reservation')
            ->join("Show", "Show.ShowID", '=', "Reservation.ShowID")
            ->join("Movie", "Show.MovieID", '=', "Movie.MovieID")
            ->where("Reservation.UserID", $request->UserID)
            ->select('*')
            ->orderBy('Date', 'ASC')
            ->get();

        return json_encode($his);
    }
}
