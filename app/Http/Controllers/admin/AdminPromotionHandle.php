<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminPromotionHandle extends Controller
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

        return view("admin/promotionAdmin", compact('prom', "otherProm"));
    }
    public function editProm(Request $request)
    {
        $promID = $request->promID;

        //Get Film Info
        $prom = DB::select("SELECT * FROM Promotion WHERE PromotionID = ?", [$promID]);

        //Handle background
        if ($request->hasFile("insertIMG")) {
            //delete background
            $OldIMG = $prom[0]->Background;
            Storage::delete('public/img/proms/' . $OldIMG);

            //Add new background
            $insertIMG = $request->file('insertIMG');
            $insertIMG_name = "img_" . uniqid() . "." . $insertIMG->extension();
            Storage::putFileAs("public/img/proms", $insertIMG, $insertIMG_name);

            //Update
            DB::table('Promotion')
                ->where('PromotionID', $promID)
                ->update(['Background' => $insertIMG_name]);
        }

        //Update the tables
        DB::table('Promotion')
            ->where('PromotionID', $promID)
            ->update([
                'Title' => $request->title,
                'Content' => $request->rule_cont,
            ]);

        return redirect(route("adminPromotion", ["PromotionID" => $promID]));
    }


    public function deleProm(Request $request)
    {
        $promID = $request->promID;

        //Get Film Info
        $prom = DB::select("SELECT * FROM Promotion WHERE PromotionID = ?", [$promID]);

        //delete background
        $OldIMG = $prom[0]->Background;
        Storage::delete('public/img/proms/' . $OldIMG);

        DB::table('Promotion')
            ->where('PromotionID', $promID)
            ->delete();

        $otherProm = DB::select("SELECT * FROM Promotion");

        return redirect(route("adminPromotion", ["PromotionID" => $otherProm[0]->PromotionID]));
    }
}
