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
                <label for="start">Ngày bắt đầu</label>
                <input style="width: 100%; height: 25px;" type="date" name="start" id="start">        
            </div>
            <div class="ctn-info">
                <label for="end">Ngày kết thúc</label>
                <input style="width: 100%; height: 25px;" type="date" name="end" id="end">
            </div>
            <div class="stat-btn show-stat">Thống kê</div>
        </div>
        <div class="cover">
            <table class="table">
                <tr >
                    <td style="width: 5%" class="til">STT</td>
                    <td  style="width: 30%" class="til">Tên phim</td>
                    <td  class="til">Ngày chiếu</td>
                    <td   class="til">Giờ chiếu</td>
                    <td   class="til">Thể loại</td>
                    <td   class="til">Số ghế đã đặt</td>
                    <td   class="til">Số ghế còn trống</td>
                </tr>
            </table>
        </div>
    </div>
</section>
@endsection

@push("SCSS&JS")
@vite(['resources/scss/stat.scss'])
<script src="{{url('js/statShow.js')}}" type="text/javascript" async></script>
@endpush
