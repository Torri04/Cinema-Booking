<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetFilm extends Controller
{
    public function index()
    {
        $shows = DB::table("Show")
            ->select('*')
            ->orderBy('StartTime', 'ASC')
            ->get();
        return json_encode($shows);
    }
}
