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
                <label for="film">Loại phim</label>
                <select style="width: 100%;height: 25px;"  name="film" id="film">
                    <option value=-1>Không</option>
                    <option value=1>Phim đang chiếu</option>
                    <option value=0>Phim sắp chiếu</option>
                </select>           
            </div>
            <div class="ctn-info">
                <label for="type">Thể loại</label>
                <input style="width: 100%; height: 25px;" type="text" name="type" id="type">
            </div>
            <div class="stat-btn movie-stat">Thống kê</div>
        </div>
        <div class="cover">
            <table class="table">
                <tr >
                    <td style="width: 5%" class="til">STT</td>
                    <td  style="width: 30%" class="til">Tên phim</td>
                    <td style="width: 30%" class="til">Thể loại</td>
                    <td   class="til">Thời lượng</td>
                    <td   class="til">Ngày ra mắt</td>
                </tr>
            </table>
        </div>
    </div>
</section>
@endsection

@push("SCSS&JS")
@vite(['resources/scss/stat.scss'])
<script src="{{url('js/statMovie.js')}}" type="text/javascript" async></script>
@endpush
