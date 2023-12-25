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
                <label for="check">Mã vé</label>
                <input style="width: 100%; height: 25px;" type="text" name="check" id="check">         
            </div>
            <div class="ctn-info">
                <label for="tel">Số điện thoại</label>
                <input style="width: 100%; height: 25px;" type="text" name="tel" id="tel">
            </div>
            <div class="stat-btn reser-stat">Thống kê</div>
        </div>
        <div class="cover">
            <table class="table">
                <tr >
                    <td style="width: 5%" class="til">STT</td>
                    <td   class="til">Tên</td>
                    <td   class="til">Email</td>
                    <td   class="til">Số điện thoại</td>
                    <td   class="til">Tổng tiền</td>
                    <td   class="til">Số ghế đã đặt</td>
                    <td   class="til">Mã vé</td>
                </tr>
            </table>
        </div>
    </div>
</section>
@endsection

@push("SCSS&JS")
@vite(['resources/scss/stat.scss'])
<script src="{{url('js/statReser.js')}}" type="text/javascript" async></script>
@endpush
