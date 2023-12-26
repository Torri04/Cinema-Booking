@extends('layouts.navbar')

@section("main-content")
<section class="sta-ctn">
    <div class="nav-info">
        <a href={{route("adminAccount")}} class="{{Request::is('admin/user/account') ? 'isMember' : ''}} opt-info">THÔNG TIN TÀI KHOẢN</a>
    </div>
    <div class="sta-info">
        <input name="userid" id="userid" hidden type="text" value="@php 
        if(Cookie::has('isAdmin'))
        {
            $user = Cookie::get('isAdmin');
            $user = json_decode($user);
            echo $user->userID;
        }
        @endphp">
        <div class="info-row">
            <div class="ctn-info">
                <label for="start">Ngày bắt đầu</label>
                <input style="width: 100%; height: 25px;" type="date" name="start" id="start">        
            </div>
            <div class="ctn-info">
                <label for="end">Ngày kết thúc</label>
                <input style="width: 100%; height: 25px;" type="date" name="end" id="end">
            </div>
            <div class="stat-btn reser-stat">Thống kê</div>
        </div>
        <div class="cover">
            <table class="table">
                <tr >
                    <td style="width: 5%" class="til">STT</td>
                    <td  style="width: 30%" class="til">Tên phim</td>
                    <td  class="til">Ngày chiếu</td>
                    <td   class="til">Giờ chiếu</td>
                    <td   class="til">Mã ghế</td>
                    <td   class="til">Tổng tiền</td>
                    <td   class="til">Mã vé</td>
                </tr>
            </table>
        </div>
    </div>
</section>
@endsection

@push("SCSS&JS")
@vite(['resources/scss/stat.scss'])
<script src="{{url('js/history.js')}}" type="text/javascript" async></script>
@endpush
