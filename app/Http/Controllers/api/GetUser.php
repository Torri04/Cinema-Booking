<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetUser extends Controller
{
    public function index(Request $request)
    {
        $user = DB::table('User')
            ->where("UserID", $request->UserID)
            ->select('*')
            ->get();
        return json_encode($user);
    }
}
