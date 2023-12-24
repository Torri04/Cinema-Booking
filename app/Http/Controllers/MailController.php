<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function __construct()
    {
    }
    //Get
    public function index(Request $request)
    {
        $emailAdd = $request->email;
        $newPass = rand(100000, 999999);

        //update
        DB::table('User')
            ->where('User', $request->user)
            ->update(['Password' => $newPass]);

        Mail::send("pages.exampleMail", ['newPass' => $newPass], function ($email) use ($emailAdd) {
            $email->subject("Quên mật khẩu");
            $email->to($emailAdd);
        });

        return redirect(route("forget"));
    }
}
