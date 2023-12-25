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
            ->where('IsShowOn', 1)
            ->orderBy('StartTime', 'ASC')
            ->get();

        $shownew = [];

        foreach ($shows as $show) {
            if ((new Carbon($show->Date))->day === Carbon::now()->day) {
                if (new Carbon($show->StartTime) >= Carbon::now()) {
                    $shownew[] = $show;
                }
            } else {
                $shownew[] = $show;
            }
        }
        return json_encode($shownew);
    }
}
