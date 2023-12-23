<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class AdminPromotionAdd extends Controller
{
    public function __construct()
    {
    }
    //GET
    public function index()
    {
        $otherProm = DB::table("Promotion")
            ->select('*')
            ->get();

        return view("admin/promotionAdminAdd", compact("otherProm"));
    }
    public function addProm(Request $request)
    {
        $insertIMG = $request->file('insertIMG');

        $insertIMG_name = "img_" . uniqid() . "." . $insertIMG->extension();

        Storage::putFileAs("public/img/proms", $insertIMG, $insertIMG_name);

        $uuid = Uuid::uuid4()->toString();

        DB::table('Promotion')->insert([
            'PromotionID' => $uuid,
            'Title' => $request->title,
            'Content' => $request->rule_cont,
            'Background' => $insertIMG_name,
        ]);

        return redirect(route("adminPromotion", ["PromotionID" => $uuid]));
    }
}
