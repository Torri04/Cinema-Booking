<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Ramsey\Uuid\Uuid;


class BookingHandle extends Controller
{
    public function __construct()
    {
    }
    public function index(Request $request)
    {
        $show = DB::table('Show')
            ->where("Show.ShowID", '=', $request->ShowID)
            ->select("*")
            ->get();

        $movieName = DB::table('Show')
            ->join("Movie", "Show.MovieID", '=', "Movie.MovieID")
            ->where("Show.ShowID", '=', $request->ShowID)
            ->select("Movie.Name")
            ->get();

        return view("client/booking", compact("show", "movieName"));
    }
    public function paymentHandle(Request $request)
    {
        $show = DB::table('Show')
            ->where("Show.ShowID", '=', $request->ShowID)
            ->select("*")
            ->get();

        $movieName = DB::table('Show')
            ->join("Movie", "Show.MovieID", '=', "Movie.MovieID")
            ->where("Show.ShowID", '=', $request->ShowID)
            ->select("Movie.Name")
            ->get();

        if (Cookie::has("isUser")) {
            $userCk = Cookie::get('isUser');
            $userCk = json_decode($userCk);

            $user = DB::table('User')
                ->where("User.UserID", '=', $userCk->userID)
                ->select("*")
                ->get();

            return view("client/payment", compact("show", "movieName", "request", "user"));
        } else {
            return view("client/payment", compact("show", "movieName", "request"));
        }
    }
}
