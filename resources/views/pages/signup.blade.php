@extends('layouts.index')
@section("content")
    <form class="form" action="" method="POST">
        @csrf
        @method("POST")
            <div class="title">Đăng Ký</div>
            <div class="ipt-container">
                <div class="ipt">                
                    <input id="user" onfocus="MyFocus1(this)" onfocusout="MyFocus2(this)" class="input" type="text"  name="user">
                    <label for="user" class="lab">Tên đăng nhập</label>
                </div>
                <div class="ipt">                
                    <input id="userName" onfocus="MyFocus1(this)" onfocusout="MyFocus2(this)" class="input" type="text"  name="userName">
                    <label for="userName" class="lab">Họ và tên</label>
                </div>
                <div class="ipt">                
                    <input id="mail" onfocus="MyFocus1(this)" onfocusout="MyFocus2(this)" class="input"  type="text"  name="mail">
                    <label for="mail" class="lab">Email</label>
                </div>
                <div class="ipt">                
                    <input id="tele" onfocus="MyFocus1(this)" onfocusout="MyFocus2(this)" class="input"  type="text"  name="tele">
                    <label for="tele" class="lab">Số điện thoại</label>
                </div>
                <div class="ipt">                
                    <input id="pass" onfocus="MyFocus1(this)" onfocusout="MyFocus2(this)" class="input"  type="password"  name="pass">
                    <label for="pass" class="lab">Mật khẩu</label>
                </div>
                <div class="ipt">                
                    <input id="re-pass" onfocus="MyFocus1(this)" onfocusout="MyFocus2(this)" class="input"  type="password"  name="re-pass">
                    <label for="re-pass" class="lab">Xác nhận mật khẩu</label>
                </div>
            </div>
            <div class="sure" >
                <input class="check" type="checkbox" name="check">
                <span class="spn">Tôi cam kết tuân theo <i class="ita">Chính sách bảo mật </i> và <i class="ita"> Điều khoản sử dụng </i> của...</span>    
            </div>
            <button class="btn">Đăng ký</button>
            <div class="bottom">
                <a class="anc" href="{{route('signin')}}"><span style="color:white">Đã đăng ký tài khoản?</span></a>
               <a class="anc" href="{{route('signin')}}"><span style="color:var(--1st-color)">Đăng nhập</span></a>
        </div>
        </form>
@endsection
@push("SCSS&JS")
@vite(['resources/scss/signup.scss'])
<script src="{{url('js/focus.js')}}" type="text/javascript" async></script>
@endpush