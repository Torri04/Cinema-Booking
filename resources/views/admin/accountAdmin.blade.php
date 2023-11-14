@extends('layouts.navbar')

@section("main-content")
<section class="member-ctn">
    <div class="nav-info">
        <a href={{route("adminAccount")}} class="{{Request::is('admin/user/account') ? 'isMember' : ''}} opt-info">THÔNG TIN TÀI KHOẢN</a>
        <a href={{route("adminMember")}} class="{{Request::is('admin/user/member') ? 'isMember' : ''}} opt-info">THẺ THÀNH VIÊN</a>
    </div>
    <div class="mem-info">
            <div class="user-ava">
                <img src="{{asset("img/avatar.jpg")}}" class="avt-img">
                <div>
                    <label for="insertAvt" class="ava-btn">TẢI ẢNH LÊN</label>
                    <input hidden id="insertAvt" name="insertAvt" type="file" accept="image/*">
                </div>
            </div>
            <div class="info-row">
                <div class="ctn-info">
                    <label for="name">Họ tên</label>
                    <input type="text" name="name" id="name">
                </div>
                <div class="ctn-info">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email">
                </div>
            </div>
            <div class="info-row">
                <div class="ctn-info">
                    <label for="tel">Số điện thoại</label>
                    <input style="width: 50%" type="text" name="tel" id="tel">
                </div>
                <div class="ctn-info">
                    <label for="birth">Ngày sinh</label>
                    <input style="width: 50%" type="text" name="birth" id="birth">
                </div>
            </div>
            <div class="info-row">
                <div class="ctn-info">
                    <label for="address">Địa chỉ</label>
                    <textarea name="address" id="address"></textarea>
                </div>
                <div class="ctn-info">
                    <label for="sex">Giới tính</label>
                    <select  name="sex" id="sex">
                        <option value="no">Không</option>
                        <option value="nam">Nam</option>
                        <option value="nu">Nữ</option>
                    </select>
                </div>
            </div>
    </div>
</section>
@endsection

@push("SCSS&JS")
@vite(['resources/scss/member.scss'])
<script src="{{url('js/insertAva.js')}}" type="text/javascript" async></script>
@endpush
