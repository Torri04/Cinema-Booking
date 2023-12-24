@extends('layouts.index')
@section("content")
    <form action={{url("mail")}} method="POST" class="form">
        @csrf
        @method("POST")
        <div class="title">Quên Mật Khẩu</div>
        <div class="ipt-container">
            <div class="ipt">                
                <input value="{{session("user")}}" id="user" onfocus="MyFocus1(this)" onfocusout="MyFocus2(this)" class="input"  type="text"  name="user">
                <label for="user" class="lab">Tài khoản</label>
            </div>
            <div class="ipt">                
                <input id="email" onfocus="MyFocus1(this)" onfocusout="MyFocus2(this)" class="input"  type="text"  name="email">
                <label for="email" class="lab">Email</label>
            </div>
        </div>
            <button class="btn">Xác nhận</button>
            <div class="bottom">
                <a class="anc" href="{{route('signin')}}"><span style="color:white">Đã đăng ký tài khoản?</span></a>
               <a class="anc" href="{{route('signin')}}"><span style="color:var(--1st-color)">Đăng nhập</span></a>
        </div>
    </form>
@endsection
@push("SCSS&JS")
@vite(['resources/scss/forget.scss'])
<script src="{{url('js/focus.js')}}" type="text/javascript" async></script>
@endpush
