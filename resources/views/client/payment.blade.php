@extends('layouts.navbar')
@php
use Carbon\Carbon;
@endphp
@section("main-content")
<form action={{url("vn_payment")}} method="POST" class="payment-ctn">
    @csrf
    @method("POST")
    <input type="text" hidden name="ShowID" value="{{$request["ShowID"]}}">
    <section class="left-side">
        <div class="info-payment">
            <img src={{asset("img/icons/user.svg")}}>
            <span>Thông tin thanh toán</span>
        </div>
        <div class="info-user">
            <div class="part1">
                <div class="ipt">
                    <span>Họ và tên:</span>
                    <input type="text" id="name" name="name" value={{isset($user)?$user[0]->Name:""}}>
                </div>
                <div class="ipt">
                    <span>Số điện thoại:</span>
                    <input type="text" id="tel" name="tel" value={{$request["tel"]}}>
                </div>
                <div class="ipt">
                    <span>Email:</span>
                    <input type="text" id="email" name="email" value={{isset($user)?$user[0]->Email:""}}>
                </div>
                <div class="ipt">
                    <span>Mã thành viên:</span>
                    <input style="pointer-events: none;" type="text" id="userid" name="userid" value={{isset($user)?$user[0]->UserID:""}}>
                </div>
            </div>
            <img class="tearline" src={{asset("img/icons/tearline.svg")}}>
            <div class="part2"></div>
        </div>
        <div class="voucher">
            <img src={{asset("img/icons/voucher.svg")}}>
            <span>Giảm giá</span>
        </div>
        <div class="voucher-name">Cinema voucher</div>
        @if(Cookie::has("isAdmin") || Cookie::has("isUser"))
        <div class="voucher-select">
            <div class="voucher-mem">
                <input class="vc-member1" name="voucher-member" type="checkbox">
                @if($user[0]->MbsLevel == "V.VIP")
                <input class="vc-value" hidden type="text" value="15">
                @elseif($user[0]->MbsLevel == "VIP")
                <input class="vc-value" hidden type="text" value="10">
                @else
                <input class="vc-value" hidden type="text" value="5">
                @endif
                <span class="vc-member2">{{$user[0]->MbsLevel}} Member</span>
            </div> 
            <span class="vou-id1">{{$user[0]->MbsLevel}}_MEMBER</span>
            <div class="vou-date">
                @php
                   $date = Carbon::createFromFormat('Y-m-d', $user[0]->CreatedDay);
                   echo $date->format('d/m/Y')." - ".$date->addYear(5)->format('d/m/Y');
                   @endphp
            </div>
        </div>
        @else
        <div class="voucher-select"></div>
        @endif
        <div class="voucher-name">Điểm tích lũy</div>
        @if(Cookie::has("isAdmin") || Cookie::has("isUser"))
        <div class="point-select">
                <div class="your-point">
                    <i>Điểm hiện có</i>
                    <span class="point">{{$user[0]->Point}}</span>
                </div>
                <div class="type-point">
                    <i>Nhập điểm</i>
                    <input name="to-type" class="type" type="text">
                </div>
                <div class="money-dec">
                    <i>Số tiền được giảm</i>
                    <span class="cash-dec">= 0 VNĐ</span>
                </div>
        </div>
        @else
        <div class="point-select"></div>
        @endif
        <div class="pay-method">
            <img src={{asset("img/icons/pay.svg")}}>
            <span>Phương thức thanh toán</span>
        </div>
        <div class="pay-name">Chọn phương thức</div>
        <div class="select-pay-method">
            <div class="mth">
                <input class="ipt-pay" type="checkbox" name="momo">
                <span>Momo</span>
            </div>
            <div class="mth">
                <input class="ipt-pay" type="checkbox" name="zalopay">
                <span>Zalo pay</span>
            </div>
            <div class="mth">
                <input class="ipt-pay" type="checkbox" name="shoppeepay">
                <span>Shoppee pay</span>
            </div>
            <div class="mth">
                <input class="ipt-pay" type="checkbox" name="card">
                <span>Chuyển khoản</span>
            </div>
        </div>
    </section>
    <section class="right-side">
        <div class="info-payment">
            <div class="above">
                <div class="mv-name">{{$movieName[0]->Name}}</div>
                <div class="cinema">
                    <span class="til">Rạp phim</span>
                    <div style=" width: calc(97.5% - 100px);height: 50px"><span class="empha">Cinema4</span>, Đường Hàn Thuyên, khu phố 6 P, Thủ Đức, Thành phố Hồ Chí Minh</div>
                </div>
                <div class="time">
                    <span class="til">Thời gian</span>
                    <input name="time" type="text"  class="empha" value="@php
                    $date = Carbon::createFromFormat('H:i:s', $show[0]->StartTime);
                    echo $date->format('H:i');
                    @endphp" >
                </div>
                <div class="room">
                    <span class="til">Phòng</span>
                    <input  name="room" type="text"  class="empha" value="B7" >
                </div>
                <div class="sheet">
                    <span class="til">Ghế ngồi</span>
                    <textarea  style="width: calc(97.5% - 100px); overflow-x: auto;" disabled id="your_seat" class="empha">{{$request->yourseat}}</textarea>
                    <input type="text" hidden name="seats" value="{{$request->yourseat}}">
                </div>
                <hr>
                <div class="price">
                    <span style="color: #637394" class="til">{{(int)str_replace(".","",$request["total-money"])/(int)str_replace(".","",$request["money"])}} x Adult</span>
                    <input name="money" id="money" style="width: 75px" type="text"  class="empha" value={{$request->money}}>
                    <span class="empha">VNĐ</span>
                </div>
                <div class="voucher">
                    <span style="color: #637394" class="til">Voucher</span>
                    <input name="voucher" id="voucher" style="width: 75px" type="text"  class="empha" value="-0 %">
                </div>
                <div class="points">
                    <span style="color: #637394" class="til">Điểm</span>
                    <input name="points" id="points" style="width: 75px" type="text"  class="empha" value="-0">
                    <span class="empha">VNĐ</span>
                </div>
                <div class="total">
                    <span style="font-weight: bold; color: #637394" class="til">Tổng tiền</span>
                    <input name="total-money" id="total-money" style="width: 75px"  type="text"  style="font-weight: bold;" class="empha" value={{$request["total-money"]}}>
                    <span class="empha">VNĐ</span>
                </div>
            </div>
            <div class="center">
                <img src={{asset("img/icons/center.svg")}} alt="">
            </div>
            <div class="bellow-2">
                <a class="a-btn" href="javascript:history.back()">Quay lại</a>
                <button name="redirect" class="a-btn">Thanh toán</button>
            </div>
        </div>
    </section>
</form>
@endsection

@push("SCSS&JS")
@vite(['resources/scss/payment.scss'])
<script src="{{url('js/onChangeCheck.js')}}" type="text/javascript" async></script>
@endpush