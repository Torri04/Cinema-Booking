@extends('layouts.navbar')

@section("main-content")
<section class="sta-ctn">
    <div class="nav-info">
        <a href={{route("adminMovieSta")}} class="{{Request::is('admin/statistics/movie') ? 'isMember' : ''}} opt-info">PHIM</a>
        <a href={{route("adminShowSta")}} class="{{Request::is('admin/statistics/show') ? 'isMember' : ''}} opt-info">LỊCH CHIẾU</a>
        <a href={{route("adminUserSta")}} class="{{Request::is('admin/statistics/user') ? 'isMember' : ''}} opt-info">NGƯỜI DÙNG</a>
        <a href={{route("adminReserSta")}} class="{{Request::is('admin/statistics/reservation') ? 'isMember' : ''}} opt-info">THANH TOÁN</a>
    </div>
    <div class="sta-info">
        <div class="info-row">
            <div class="ctn-info">
                <label for="name">Tên người dùng</label>
                <input style="width: 100%; height: 25px;" type="text" name="name" id="name">         
            </div>
            <div class="ctn-info">
                <label for="email">Email</label>
                <input style="width: 100%; height: 25px;" type="text" name="email" id="email">
            </div>
            <div class="stat-btn user-stat">Thống kê</div>
        </div>
        <div class="cover">
            <table class="table">
                <tr >
                    <td style="width: 5%" class="til">STT</td>
                    <td   class="til">Tên</td>
                    <td   class="til">Email</td>
                    <td   class="til">Số điện thoại</td>
                    <td   class="til">Hạng thẻ</td>
                    <td   class="til">Chi tiêu</td>
                </tr>
            </table>
        </div>
    </div>
</section>
@endsection

@push("SCSS&JS")
@vite(['resources/scss/stat.scss'])
<script src="{{url('js/statUser.js')}}" type="text/javascript" async></script>
@endpush
