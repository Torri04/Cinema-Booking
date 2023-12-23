<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GetFilm extends Controller
{
    public function index()
    {
        $shows = DB::table("Show")
            ->select('*')
            ->where('StartTime', ">=", Carbon::now()->toTimeString())
            ->where('IsShowOn', 1)
            ->orderBy('StartTime', 'ASC')
            ->get();
        return json_encode($shows);
    }
}
