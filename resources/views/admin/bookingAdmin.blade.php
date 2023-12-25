@extends('layouts.navbar')
@php
use Carbon\Carbon;
@endphp
@section("main-content")
<div class="booking-ctn">
    <section class="left-side">
        <div class="frame">
            <div class="til">Màn hình</div>
            <img src={{asset("img/icons/screen.svg")}} alt="">
        </div>
        <div class="sheet">
            <div class="sheet-row">
                @for($i = 1; $i <= 15 ; $i++)
                <span id='A{{$i}}' class="ord-sheet">{{$i}}</span>
                @endfor
                <span class="ord-char">A</span>
            </div>
            <div class="sheet-row">
                @for($i = 1; $i <= 15 ; $i++)
                <span id='B{{$i}}' class="ord-sheet">{{$i}}</span>
                @endfor
                <span class="ord-char">B</span>
            </div>
            <div class="sheet-row">
                @for($i = 1; $i <= 15 ; $i++)
                <span id='C{{$i}}' class="ord-sheet">{{$i}}</span>
                @endfor
                <span class="ord-char">C</span>
            </div>
            <div class="sheet-row">
                @for($i = 1; $i <= 15 ; $i++)
                <span id='D{{$i}}' class="ord-sheet">{{$i}}</span>
                @endfor
                <span class="ord-char">D</span>
            </div>
            <div class="sheet-row">
                @for($i = 1; $i <= 15 ; $i++)
                <span id='E{{$i}}' class="ord-sheet">{{$i}}</span>
                @endfor
                <span class="ord-char">E</span>
            </div>
            <div class="sheet-row">
                @for($i = 1; $i <= 15 ; $i++)
                <span id='F{{$i}}' class="ord-sheet">{{$i}}</span>
                @endfor
                <span class="ord-char">F</span>
            </div>
            <div class="sheet-row">
                @for($i = 1; $i <= 15 ; $i++)
                <span id='G{{$i}}' class="ord-sheet">{{$i}}</span>
                @endfor
                <span class="ord-char">G</span>
            </div>
            <div class="sheet-row">
                @for($i = 1; $i <= 15 ; $i++)
                <span id='H{{$i}}' class="ord-sheet">{{$i}}</span>
                @endfor
                <span class="ord-char">H</span>
            </div>
            <div class="sheet-row">
                @for($i = 1; $i <= 15 ; $i++)
                <span id='K{{$i}}' class="ord-sheet">{{$i}}</span>
                @endfor
                <span class="ord-char">K</span>
            </div>
            <div class="sheet-row">
                @for($i = 1; $i <= 15 ; $i++)
                <span id='L{{$i}}' class="ord-sheet">{{$i}}</span>
                @endfor
                <span class="ord-char">L</span>
            </div>
            <div class="end-row">
                <div class="row-ctn">
                    <img src={{asset("img/icons/selected.svg")}} alt="">
                    <span>Ghế đang chọn</span>
                </div>
                <div class="row-ctn">
                    <img src={{asset("img/icons/unselected.svg")}} alt="">
                    <span>Ghế trống</span>
                </div>
                <div class="row-ctn">
                    <img src={{asset("img/icons/sold.svg")}} alt="">
                    <span>Ghế đã bán</span>
                </div>
            </div>
        </div>
    </section>
    <form action="" method="POST" class="right-side">
        @csrf
        @method("POST")
        <div class="info-payment">
            <div class="above">
                <div class="mv-name">{{$movieName[0]->Name}}</div>
                <div class="cinema">
                    <span class="til">Rạp phim</span>
                    <div style=" width: calc(97.5% - 100px);height: 50px"><span class="empha">KFCinema</span>, Đường Hàn Thuyên, khu phố 6 P, Thủ Đức, Thành phố Hồ Chí Minh</div>
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
                    <textarea name="yourseat" style="width: calc(97.5% - 100px); overflow-x: auto;" disabled id="your_seat" class="empha"></textarea>
                    <input class="txt" name="yourseat" hidden type="text" >
                </div>
                <hr>
                <div class="price">
                    <span style="color: #637394" class="til">0 x Adult</span>
                    <input name="money" id="money" style="width: 75px" type="text"  class="empha" value="65.000">
                    <span class="empha">VNĐ</span>
                </div>
                <div class="total">
                    <span style="font-weight: bold; color: #637394" class="til">Tổng tiền</span>
                    <input name="total-money" id="total-money" style="width: 75px"  type="text"  style="font-weight: bold;" class="empha" value="0">
                    <span class="empha">VNĐ</span>
                </div>
            </div>
            <div class="center">
                <img src={{asset("img/icons/center.svg")}} alt="">
            </div>
            <div class="bellow">
                <input name="tel" class="tel" type="text" placeholder="Số điện thoại" value="@php 
                if(Cookie::has('isAdmin'))
                {
                    $user = Cookie::get('isAdmin');
                    $user = json_decode($user);
                    echo $user->phone;
                }
                @endphp">
                <button class="pay-btn">Tiếp tục</button>
            </div>
        </div>
    </form>
</div>
@endsection

@push("SCSS&JS")
@vite(['resources/scss/booking.scss'])
<script src="{{url('js/reservedSeats.js')}}" type="text/javascript" async></script>
@endpush