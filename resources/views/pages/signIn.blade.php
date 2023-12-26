@extends('layouts.index')
@section("content")
    <form class="form" action="signin" method="POST">
        @csrf
        @method("POST")
        <div class="title">Đăng nhập</div>
        <div class="ipt-container">
            <div class="ipt">                
                <input value="{{session("user")}}" id="user" onfocus="MyFocus1(this)" onfocusout="MyFocus2(this)" class="input"  type="text"  name="user">
                <label for="user" class="lab">Tài khoản</label>
            </div>
            <div class="ipt">                
                <input id="pass" onfocus="MyFocus1(this)" onfocusout="MyFocus2(this)" class="input"  type="password"  name="pass">
                <label for="pass" class="lab">Mật khẩu</label>
            </div>
        </div>
        <div class="sure" >
            <div class="remem">
               <input type="checkbox" name="check">
               <span class="spn">Ghi nhớ mật khẩu
            </div>
               <a href="{{route("forget")}}" class="forget">Quên mật khẩu?</a>
            </div>

            <button class="btn">Đăng nhập</button>
        <div class="bottom">
            <a class="anc" href="{{route('signup')}}"><span style="color:white">Chưa đăng ký tài khoản?</span></a>
           <a class="anc" href="{{route('signup')}}"><span style="color:var(--1st-color)">Đăng ký</span></a>
    </div>
    </form>
@endsection
@push("SCSS&JS")
@vite(['resources/scss/signin.scss'])
<script src="{{url('js/focus.js')}}" type="text/javascript" async></script>
@endpush
