<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetSeat extends Controller
{
    public function index(Request $request)
    {
        $seat = DB::table('Reservation')
            ->join('Show', 'Reservation.ShowID', '=', 'Show.ShowID')
            ->where("Reservation.ShowID", $request->ShowID)
            ->select('Seat')
            ->get();
        return json_encode($seat);
    }
}
