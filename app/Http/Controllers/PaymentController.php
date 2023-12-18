<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        if (Cookie::has("isAdmin")) {
            $new_arr = explode(";", $request["vnp_OrderInfo"]);

            $user_ck = Cookie::get('isAdmin');
            $user_ck = json_decode($user_ck);

            $user = DB::table('User')
                ->where('UserID', $user_ck->userID)
                ->get();

            $expense = $user[0]->Expense + (int)$request["vnp_Amount"] / 100;
            $point = $user[0]->Point - (int)$new_arr[5] + (int)$request["vnp_Amount"] / 1000000;

            if ($expense >= 7000000) {
                $user = DB::table('User')
                    ->where('UserID', $user_ck->userID)
                    ->update(['MbsLevel' => "V.VIP", 'Expense' => $expense, "Point" => $point]);
            } elseif ($expense >= 2000000) {
                $user = DB::table('User')
                    ->where('UserID', $user_ck->userID)
                    ->update(['MbsLevel' => "VIP", 'Expense' => $expense, "Point" => $point]);
            } else {
                $user = DB::table('User')
                    ->where('UserID', $user_ck->userID)
                    ->update(['MbsLevel' => "Standard", 'Expense' => $expense, "Point" => $point]);
            }

            $ReservationID = Uuid::uuid4()->toString();

            DB::table('Reservation')->insert([
                'ReservationID' => $ReservationID,
                'ShowID' => $new_arr[6],
                'UserID' => $user_ck->userID,
                'Seat' => $new_arr[3],
                'Total' => (int)$request["vnp_Amount"] / 100,
                'UserName' => $new_arr[0],
                'Phone' => $new_arr[1],
                'Email' => $new_arr[2],
                'PayCheck' => $request->vnp_TxnRef,
            ]);

            DB::table('Payment')->insert([
                'PaymentID' => Uuid::uuid4()->toString(),
                'ReservationID' => $ReservationID,
                'Total' => (int)$request["vnp_Amount"] / 100,
                'CardType' => $request->vnp_CardType,
            ]);
        } elseif (Cookie::has("isUser")) {
            $new_arr = explode(";", $request["vnp_OrderInfo"]);

            $user_ck = Cookie::get('isUser');
            $user_ck = json_decode($user_ck);

            $user = DB::table('User')
                ->where('UserID', $user_ck->userID)
                ->get();

            $expense = $user[0]->Expense + (int)$request["vnp_Amount"] / 100;
            $point = $user[0]->Point - (int)$new_arr[5] + (int)$request["vnp_Amount"] / 1000000;

            if ($expense >= 7000000) {
                $user = DB::table('User')
                    ->where('UserID', $user_ck->userID)
                    ->update(['MbsLevel' => "V.VIP", 'Expense' => $expense, "Point" => $point]);
            } elseif ($expense >= 2000000) {
                $user = DB::table('User')
                    ->where('UserID', $user_ck->userID)
                    ->update(['MbsLevel' => "VIP", 'Expense' => $expense, "Point" => $point]);
            } else {
                $user = DB::table('User')
                    ->where('UserID', $user_ck->userID)
                    ->update(['MbsLevel' => "Standard", 'Expense' => $expense, "Point" => $point]);
            }

            $ReservationID = Uuid::uuid4()->toString();

            DB::table('Reservation')->insert([
                'ReservationID' => $ReservationID,
                'ShowID' => $new_arr[6],
                'UserID' => $user_ck->userID,
                'Seat' => $new_arr[3],
                'Total' => (int)$request["vnp_Amount"] / 100,
                'UserName' => $new_arr[0],
                'Phone' => $new_arr[1],
                'Email' => $new_arr[2],
                'PayCheck' => $request->vnp_TxnRef,
            ]);

            DB::table('Payment')->insert([
                'PaymentID' => Uuid::uuid4()->toString(),
                'ReservationID' => $ReservationID,
                'Total' => (int)$request["vnp_Amount"] / 100,
                'CardType' => $request->vnp_CardType,
            ]);
        } else {
            $new_arr = explode(";", $request["vnp_OrderInfo"]);

            $ReservationID = Uuid::uuid4()->toString();

            DB::table('Reservation')->insert([
                'ReservationID' => $ReservationID,
                'ShowID' => $new_arr[6],
                'Seat' => $new_arr[3],
                'Total' => (int)$request["vnp_Amount"] / 100,
                'UserName' => $new_arr[0],
                'Phone' => $new_arr[1],
                'Email' => $new_arr[2],
                'PayCheck' => $request->vnp_TxnRef,
            ]);

            DB::table('Payment')->insert([
                'PaymentID' => Uuid::uuid4()->toString(),
                'ReservationID' => $ReservationID,
                'Total' => (int)$request["vnp_Amount"] / 100,
                'CardType' => $request->vnp_CardType,
            ]);
        }

        $info = $request->vnp_TxnRef;
        return view("pages/return", compact("info"));
    }

    public function vnpayment(Request $request)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/return";
        $vnp_TmnCode = "DBHKB56G"; //Mã website tại VNPAY 
        $vnp_HashSecret = "IJLTMMMYYRRZXOPNKAWIVZUCPGFCFWTV"; //Chuỗi bí mật

        $vnp_TxnRef = (string)rand(5000, 9999); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $request["name"] . ";" . $request["tel"] . ";" . $request["email"] . ";" . $request["seats"] . ";" . $request["total-money"] . ";" . $request["to-type"] . ";" . $request["ShowID"];
        $vnp_OrderType = "Cinema Booking";
        $vnp_Amount = (int)str_replace(".", "", $request["total-money"]) * 100;
        $vnp_Locale = "vn";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,

        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
        // vui lòng tham khảo thêm tại code demo
    }
}
