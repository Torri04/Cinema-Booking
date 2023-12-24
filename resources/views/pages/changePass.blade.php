@extends('layouts.index')
@section("content")
    <form action="" method="POST" class="form">
        @csrf
        @method("POST")
        <div class="title">Đổi Mật Khẩu</div>
        <div class="ipt-container">
            <div class="ipt">                
                <input value="{{session("user")}}" id="oldpass" onfocus="MyFocus1(this)" onfocusout="MyFocus2(this)" class="input"  type="password"  name="oldpass">
                <label for="oldpass" class="lab">Mật khẩu cũ</label>
            </div>
            <div class="ipt">                
                <input id="newpass" onfocus="MyFocus1(this)" onfocusout="MyFocus2(this)" class="input"  type="password"  name="newpass">
                <label for="newpass" class="lab">Mật khẩu mới</label>
            </div>
            <div class="ipt">                
                <input id="re-newpass" onfocus="MyFocus1(this)" onfocusout="MyFocus2(this)" class="input"  type="password"  name="re-newpass">
                <label for="re-newpass" class="lab">Xác nhận lại mật khẩu</label>
            </div>
        </div>
            <button class="btn">Xác nhận</button>
            <div class="bottom">
                <a class="anc" href="{{Cookie::has('isAdmin')?route('adminAccount'):route('userAccount')}}"><span style="color:white">Quay trở lại</span></a>
        </div>
    </form>
@endsection
@push("SCSS&JS")
@vite(['resources/scss/changePass.scss'])
<script src="{{url('js/focus.js')}}" type="text/javascript" async></script>
@endpush
