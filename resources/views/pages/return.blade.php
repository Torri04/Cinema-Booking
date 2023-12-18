@extends('layouts.index')
@section("content")
    <div class="pay-note">
        <div class="title">Thanh toán thành công</div>
        <div class="num-note">Mã thanh toán của bạn là</div>
        <div class="num">{{$info}}</div>
        <div class="note"><span>Lưu ý:</span> Bạn hãy chụp ảnh màn hình lại và khi tới rạp hãy đưa ảnh này cho nhân viên kiểm tra</div>
        <a class="anc" href="{{Cookie::has("isAdmin")?route("adminHome"):route("home")}}">Quay trở lại trang chủ</a>
    </div>
@endsection
@push("SCSS&JS")
@vite(['resources/scss/return.scss'])
@endpush
