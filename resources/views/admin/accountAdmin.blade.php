@extends('layouts.navbar')

@section("main-content")
<section class="member-ctn">
    <div class="nav-info">
        <a href={{route("adminAccount")}} class="{{Request::is('admin/user/account') ? 'isMember' : ''}} opt-info">THÔNG TIN TÀI KHOẢN</a>
        <a href={{route("adminMember")}} class="{{Request::is('admin/user/member') ? 'isMember' : ''}} opt-info">THẺ THÀNH VIÊN</a>
    </div>
    <div class="mem-info">
            
    </div>
</section>
@endsection

@push("SCSS&JS")
@vite(['resources/scss/member.scss'])
@endpush
