<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromotionHandle extends Controller
{
    public function __construct()
    {
    }
    //GET
    public function index(Request $request)
    {
        $prom = DB::table("Promotion")
            ->select('*')
            ->where("PromotionID", $request->PromotionID)
            ->get();

        $otherProm = DB::table("Promotion")
            ->select('*')
            ->where("PromotionID", "<>", $request->PromotionID)
            ->get();

        return view("client/promotion", compact('prom', "otherProm"));
    }
}
