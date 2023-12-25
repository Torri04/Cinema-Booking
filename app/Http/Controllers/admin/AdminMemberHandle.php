<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;

class AdminMemberHandle extends Controller
{
    public function __construct()
    {
    }
    //GET
    public function index()
    {
        $userCk = Cookie::get('isAdmin');
        $userCk = json_decode($userCk);

        $user = DB::table('User')
            ->where('UserID', $userCk->userID)
            ->select('*')
            ->get();

        return view("admin/accountAdmin", compact("user"));
    }
    public function accountEdit(Request $request)
    {
        //Get User Info
        $user = DB::select("SELECT * FROM User WHERE UserID = ?", [$request->userID]);

        //Handle Avt
        if ($request->hasFile("insertAvt")) {
            if ($user[0]->Avatar) {
                //delete Avt
                $OldAvt = $user[0]->Avatar;
                Storage::delete('public/img/users/' . $OldAvt);
            }
            //Add new Avt
            $insertAvt = $request->file('insertAvt');
            $insertAvt_name = "img_" . uniqid() . "." . $insertAvt->extension();
            Storage::putFileAs("public/img/users", $insertAvt, $insertAvt_name);

            //Update
            DB::table('User')
                ->where('UserID', $request->userID)
                ->update(['Avatar' => $insertAvt_name]);

            //Update the cookie
            $userStorage = ['userID' => $user[0]->UserID, 'user' => $user[0]->User, 'avatar' => $insertAvt_name];
            $array_json = json_encode($userStorage);
            Cookie::queue(Cookie::make('isAdmin', $array_json, 15));
        }

        //Update the tables
        DB::table('User')
            ->where('UserID', $request->userID)
            ->update([
                'Name' => $request->name,
                'Email' => $request->email,
                'Phone' => $request->tel,
                'Birth' => $request->birth,
                'Address' => $request->address,
                'Sex' => $request->sex,
            ]);

        return redirect(route('adminAccount'));
    }

    public function memberAdmin()
    {
        $userCk = Cookie::get('isAdmin');
        $userCk = json_decode($userCk);

        $user = DB::table('User')
            ->where('UserID', $userCk->userID)
            ->select('*')
            ->get();

        return view("admin/memberAdmin", compact("user"));
    }

    public function historyHandle()
    {
        return view("admin/historyAdmin");
    }
}
