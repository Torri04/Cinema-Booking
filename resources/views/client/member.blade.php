@extends('layouts.navbar')

@section("main-content")
<section class="member-ctn">
    <div class="nav-info">
        <a href={{route("userAccount")}} class="{{Request::is('user/account') ? 'isMember' : ''}} opt-info">THÔNG TIN TÀI KHOẢN</a>
        <a href={{route("userMember")}} class="{{Request::is('user/member') ? 'isMember' : ''}} opt-info">THẺ THÀNH VIÊN</a>
    </div>
    <div class="mem-info">
            
    </div>
</section>
@endsection

@push("SCSS&JS")
@vite(['resources/scss/member.scss'])
@endpush
