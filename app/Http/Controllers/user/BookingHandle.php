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
        if ($request->card || $request->momo || $request->shoppeepay || $request->zalopay) {
            if (Cookie::has("isUser")) {
                $user = DB::table('User')
                    ->where('UserID', $request->userid)
                    ->get();

                $expense = $user[0]->Expense + (int)str_replace(".", "", $request["total-money"]);
                $point = $user[0]->Point - (int)$request["to-type"] + (int)str_replace(".", "", $request["total-money"]) / 10000;

                if ($expense >= 7000000) {
                    $user = DB::table('User')
                        ->where('UserID', $request->userid)
                        ->update(['MbsLevel' => "V.VIP", 'Expense' => $expense, "Point" => $point]);
                } elseif ($expense >= 2000000) {
                    $user = DB::table('User')
                        ->where('UserID', $request->userid)
                        ->update(['MbsLevel' => "VIP", 'Expense' => $expense, "Point" => $point]);
                } else {
                    $user = DB::table('User')
                        ->where('UserID', $request->userid)
                        ->update(['MbsLevel' => "Standard", 'Expense' => $expense, "Point" => $point]);
                }

                DB::table('Reservation')->insert([
                    'ReservationID' => Uuid::uuid4()->toString(),
                    'ShowID' => $request->ShowID,
                    'UserID' => $request->userid,
                    'Seat' => $request->seats,
                    'Total' => (int)str_replace(".", "", $request["total-money"]),
                ]);
                return redirect(route("home"));
            } else {
                DB::table('Reservation')->insert([
                    'ReservationID' => Uuid::uuid4()->toString(),
                    'ShowID' => $request->ShowID,
                    'Seat' => $request->seats,
                    'Total' => (int)str_replace(".", "", $request["total-money"]),
                ]);
                return redirect(route("home"));
            }
        } else {

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
}
