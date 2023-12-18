<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Ramsey\Uuid\Uuid;

class AdminBookingHandle extends Controller
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

        return view("admin/bookingAdmin", compact("show", "movieName"));
    }
    public function paymentHandle(Request $request)
    {
        if (Cookie::has("isAdmin")) {
            $userCk = Cookie::get('isAdmin');
            $userCk = json_decode($userCk);

            $user = DB::table('User')
                ->where("User.UserID", '=', $userCk->userID)
                ->select("*")
                ->get();

            $show = DB::table('Show')
                ->where("Show.ShowID", '=', $request->ShowID)
                ->select("*")
                ->get();

            $movieName = DB::table('Show')
                ->join("Movie", "Show.MovieID", '=', "Movie.MovieID")
                ->where("Show.ShowID", '=', $request->ShowID)
                ->select("Movie.Name")
                ->get();

            return view("admin/paymentAdmin", compact("show", "movieName", "request", "user"));
        }
    }
}
