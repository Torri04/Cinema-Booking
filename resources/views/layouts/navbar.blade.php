@extends('layouts.index')
@php
if(Cookie::has('isAdmin'))
{
    $user=Cookie::get('isAdmin');
    $user=json_decode($user);
}
else if(Cookie::has('isUser'))
{
    $user=Cookie::get('isUser');
    $user=json_decode($user);
}
@endphp
@section("content")
<section class="container-header">
    <header class="header">
        <div class="promo">
            <div class="new">New</div>
            <div>Đăng ký thành viên để hưởng ưu đãi đồng giá 59k cho mọi xuất chiếu.<a class="anchor" href="#"> Xem thêm</a></div>
        </div>
        <div class="nav-bar">
            <div class="remain deco">
                <img src="{{asset('img/icons/deco.svg')}}" alt="">
            </div>
            <nav class="switch">
                <a class="{{(Request::is('/') || Request::is('admin')) ? 'isActive' : ''}} a-sw" href="{{Cookie::has('isAdmin')?route('adminHome'):route('home')}}">Trang chủ</a>
                <a class="{{(Request::is('film/*') || Request::is('admin/film/*')) ? 'isActive' : ''}} a-sw" href="{{Cookie::has('isAdmin')?route('adminFilm',["Film" => "coming"]):route('film',["Film" => "coming"])}}">Phim</a>
                <a class="{{(Request::is('promotion') || Request::is('admin/promotion')) ? 'isActive' : ''}} a-sw" href="{{Cookie::has('isAdmin')?route('adminPromotion'):route('promotion')}}">Ưu đãi - Sự kiện</a>
            </nav>
            @if(Cookie::has('isAdmin'))
            <div class="userBox remain" >
                <a href="{{route("adminAccount")}}" class='sign-box' style="text-decoration: none; color: var(--1st-color);" >
                    <img class="avatar" width="100%" src="{{$user->avatar?asset("storage/img/users/".$user->avatar):asset("storage/img/users/default.jpg")}}" >
                    <div>{{$user->user}}</div>
               </a>
               <i class="out-icon fa fa-sign-out" aria-hidden="true"></i>
            </div>
            @elseif(Cookie::has('isUser'))
            <div class="userBox remain" >
                <a href="{{route("userAccount")}}" class='sign-box' style="text-decoration: none; color: var(--1st-color);" >
                    <img class="avatar" width="100%" src="{{$user->avatar?asset("storage/img/users/".$user->avatar):asset("storage/img/users/default.jpg")}}" >
                    <div>{{$user->user}}</div>
               </a>
               <i class="out-icon fa fa-sign-out" aria-hidden="true"></i>
            </div>
            @else
            <div class='remain sign-box'>
                <a style='text-decoration: none' href="{{route('signup')}}"><div class='signup-box'>Đăng ký</div></a>
                <a style='text-decoration: none' href="{{route('signin')}}"><div class='signin-box'>Đăng nhập</div></a>
            </div>
            @endif
        </div>
    </header>
    </section>
    @yield('main-content')
    @yield('footer')
    <div class="signout-contain" >
        <div class="title">Bạn có chắc muốn đăng xuất?</div>
        <div class="sign-out">
          <a href="{{route("signout")}}" class="signout-btn">Đăng xuất</a>
          <div onclick="clickCancelSignout()" class="cancelSignout-btn">Hủy bỏ</div>
        </div>
    </div>
@endsection
@push("SCSS&JS")
@vite(['resources/scss/navbar.scss'])
<script src="{{url('js/clickSignout.js')}}" type="text/javascript" async></script>
@endpush
