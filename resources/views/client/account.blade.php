@extends('layouts.navbar')

@section("main-content")
<section class="member-ctn">
    <div class="nav-info">
        <a href={{route("userAccount")}} class="{{Request::is('user/account') ? 'isMember' : ''}} opt-info">THÔNG TIN TÀI KHOẢN</a>
        <a href={{route("userMember")}} class="{{Request::is('user/member') ? 'isMember' : ''}} opt-info">THẺ THÀNH VIÊN</a>
        <a href={{route("userHistory")}} class="{{Request::is('user/history') ? 'isMember' : ''}} opt-info">LỊCH SỬ ĐẶT VÉ</a>
    </div>
    <form method="POST" action="" class="acc-info" enctype="multipart/form-data">
        @csrf
        @method("POST")
            <input hidden id="userID" name="userID" type="text" value={{$user[0]->UserID}}>
            <div class="user-ava">
                <img  src="{{$user[0]->Avatar?asset("storage/img/users/".$user[0]->Avatar):asset("storage/img/users/default.jpg")}}" class="avt-img">
                <div>
                    <label for="insertAvt" class="ava-btn">TẢI ẢNH LÊN</label>
                    <input class="unable" hidden id="insertAvt" name="insertAvt" type="file" accept="image/*">
                </div>
            </div>
            <div class="info-row">
                <div class="ctn-info unable">
                    <label for="name">Họ tên</label>
                    <input type="text" name="name" id="name" value="{{$user[0]->Name}}">
                </div>
                <div class="ctn-info unable">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value={{$user[0]->Email}}>
                </div>
            </div>
            <div class="info-row">
                <div class="ctn-info unable">
                    <label for="tel">Số điện thoại</label>
                    <input style="width: 50%" type="text" name="tel" id="tel" value={{$user[0]->Phone}}>
                </div>
                <div class="ctn-info unable">
                    <label for="birth">Ngày sinh</label>
                    <input style="width: 50%" type="date" name="birth" id="birth" value={{$user[0]->Birth}}>
                </div>
            </div>
            <div class="info-row">
                <div class="ctn-info">
                    <label for="address">Địa chỉ</label>
                    <textarea disabled name="address" id="address">{{$user[0]->Address}}</textarea>
                </div>
                <div class="ctn-info">
                    <label class="unable" for="sex">Giới tính</label>
                    <select class="unable" style="width: 25%"  name="sex" id="sex">
                        <option @if($user[0]->Sex == "") selected @endif value="">Không</option>
                        <option @if($user[0]->Sex == "1") selected @endif value="1">Nam</option>
                        <option @if($user[0]->Sex == "0") selected @endif value="0">Nữ</option>
                    </select>
                    <a href="{{route("changePass")}}" class="change-pass">Đổi mật khẩu?</a>
                </div>
            </div>
            <div class="edit-row">
                <div onclick="clickEdit(this)" class="edit-btn">Chỉnh sửa</div>
                <a href="" class="cancle">Hủy bỏ</a>
                <button class="save">Lưu</button>
            </div>    
        </form>
</section>
@endsection

@push("SCSS&JS")
@vite(['resources/scss/member.scss'])
<script src="{{url('js/insertAva.js')}}" type="text/javascript" async></script>
<script src="{{url('js/clickEditAccount.js')}}" type="text/javascript" async></script>
@endpush
