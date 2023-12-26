@extends('layouts.navbar')
@php
use Carbon\Carbon;
@endphp
@section("main-content")
<form action="" method="POST" class="ctn-container" enctype="multipart/form-data">
    @csrf
    @method("POST")
    <div class="left-side">
        <div class="cont">
            <input id="MovieID" name="MovieID" hidden value="{{$movie[0]->MovieID}}">
            <input id="Name" name="Name" class="title ipt unable" type="text" value="{{$movie[0]->Name}}">
            <input id="Lan" name="Lan" class="lan ipt unable" type="text" value="{{$movie[0]->Language}}">
            <input id="Genres" name="Genres" class="type ipt unable" type="text" value="{{$movie[0]->Genres}}">
            <div class="date-time">
                <div class="cover">
                   <img src="{{asset('img/icons/home.svg')}}">
                   <input id="Date" name="Date" class="date ipt unable" type="text" value="@php
                   $date = Carbon::createFromFormat('Y-m-d', $movie[0]->ReleaseDate);
                   echo $date->format('d/m/Y');
                   @endphp
                   ">
                </div>
                <div class="cover">
                   <img src="{{asset('img/icons/home.svg')}}">
                   <input id="Dur" name="Dur" class="dur ipt unable" type="text" value="@php
                   $date = Carbon::createFromFormat('H:i:s', $movie[0]->Duration);
                   echo $date->format('H') . 'h ' . $date->format('i') . 'm';
                   @endphp">
                </div>
            </div>
            <div class="tit">Đạo diễn</div>
            <input id="Direc" name="Direc" class="tit-cnt ipt unable" type="text" value="{{$movie[0]->Director}}">
            <div class="tit">Diễn viên chính</div>
            <textarea style="height: 55px" id="Actor" name="Actor" disabled class="tit-cnt ipt txtare">{{$movie[0]->Actors}}</textarea>
            <div class="tit">Nội dung</div>
            <textarea id="Content" name="Content" disabled class="content ipt txtare">{{$movie[0]->Content}}</textarea>
            <div class="edit-row">
                <div onclick="clickEdit(this)" class="edit-btn">Chỉnh sửa</div>
                <a href="" class="cancle">Hủy bỏ</a>
                <button class="save">Lưu</button>
            </div>
        </div>
    </div>
    <div class="right-side">
        <label for="insertIMG" style="background: var(--2st-color); cursor: pointer" class="film-info ins unable">
            <img class="imgs" src="{{asset('storage/img/movies/' . $movie[0]->Background)}}">
            <input id="insertIMG" class="ins-ipt" name="insertIMG" type="file" accept="image/*" hidden>
        </label>
        <label for="insertPoster" style="background: var(--2st-color); cursor: pointer" class="poster ins unable">
            <img class="imgs" src="{{asset('storage/img/posters/' . $movie[0]->Poster)}}">
            <input id="insertPoster" class="ins-ipt" name="insertPoster" type="file" accept="image/*" hidden>
        </label> 
        <input id="trailer" name="trailer" type ="text" class="trail" value="{{$movie[0]->Link}}">
        <div onclick="watchTrailer()" class="trailer">
            <img class="cc" src="{{asset('img/icons/play.svg')}}">
            <span>XEM TRAILER</span>
        </div>
        <div class="schedule">
            <div class="dates">
                <a href= "{{route('adminInfoEdit',["Name" => $movie[0]->Name,"Day" => "1stDay"])}}" class="{{Request::is('admin/infoEdit/*/1stDay') ? 'isOnShow' : ''}} datee">
                    <span class="day"><?php echo date("d")?></span>
                    <span class="month">/<?php echo date("m")?> - <?php echo date("D")?></span>
                </a>
                <a href= "{{route('adminInfoEdit',["Name" => $movie[0]->Name,"Day" => "2ndDay"])}}" class="{{Request::is('admin/infoEdit/*/2ndDay') ? 'isOnShow' : ''}} datee">
                    <span class="day"><?php echo date("d", strtotime(' +1 day'))?></span>
                    <span class="month">/<?php echo date("m",strtotime(' +1 day'))?> - <?php echo date("D",strtotime(' +1 day'))?></span>
                </a>
                <a href= "{{route('adminInfoEdit',["Name" => $movie[0]->Name,"Day" => "3rdDay"])}}" class="{{Request::is('admin/infoEdit/*/3rdDay') ? 'isOnShow' : ''}} datee">
                    <span class="day"><?php echo date("d",strtotime(' +2 day'))?></span>
                    <span class="month">/<?php echo date("m",strtotime(' +2 day'))?> - <?php echo date("D",strtotime(' +2 day'))?></span>
                </a>
            </div>
            <div class="time">
                <div class="title">2D PHỤ ĐỀ</div>
                <div class="time-frames">
                    @forelse($shows_1 as $key => $show)
                    <div class="ctn-show">
                        <input date="@php $dates = Carbon::createFromFormat('Y-m-d', $show->Date);echo $dates->format('d/m/Y');@endphp" key="{{$show->ShowID}}" name="show_1_{{$key}}" readonly type="text" class="frame-s ipt" value="@php
                        $date = Carbon::createFromFormat('H:i:s', $show->StartTime);
                        echo $date->format('H:i');
                        @endphp">
                        <input type="text" hidden value={{route('adminBooking',['ShowID'=>$show->ShowID])}}>
                        <span class="show-dlt">-</span>
                    </div>
                    @empty
                    @endforelse
                    <input name="add-2" type="button" class="isShow frame-add ipt clickAdd-1" value="&plus;">                
                </div>
            </div>
            <div class="time">
                <div class="title">2D LỒNG TIẾNG</div>
                <div class="time-frames">
                    @forelse($shows_2 as $key => $show)
                    <div class="ctn-show">
                        <input date="@php $dates = Carbon::createFromFormat('Y-m-d', $show->Date);echo $dates->format('d/m/Y');@endphp" key="{{$show->ShowID}}" name="show_2_{{$key}}" readonly type="text" class="frame-s ipt" value="@php
                        $date = Carbon::createFromFormat('H:i:s', $show->StartTime);
                        echo $date->format('H:i');
                        @endphp">
                        <input type="text" hidden value={{route('adminBooking',['ShowID'=>$show->ShowID])}}>
                        <span class="show-dlt">-</span>
                    </div>
                    @empty
                    @endforelse
                    <input name="add-1" type="button" class="isShow frame-add ipt clickAdd-2" value="&plus;">                
                </div>
            </div>
        </div>
    </div>
</form>
<div onclick="closeClick()" id="ovl" class="overlay"></div>
<div class="frame">
    <iframe width="560" height="315" src="{{$movie[0]->Link}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    <span onclick="closeClick()" class="spn" class="spn">&times;</span>
</div>
<div class="booking-contain" >
    <div class="title">Bạn đang đặt vé xem phim</div>
    <hr class="hr">
    <div class="mv-name">{{$movie[0]->Name}}</div>
    <hr class="hr">
    <div class="table-info">
        <span class="spn-info">Rạp phim</span>
        <span class="spn-info">Ngày chiếu</span>
        <span class="spn-info">Giờ chiếu</span>
    </div>
    <div class="mv-info">
        <span class="spn-info">KFCinema</span>
        <span class="spn-info show-date">Ngày chiếu</span>
        <span class="spn-info show-time">Giờ chiếu</span>
    </div>
    <div class="end-row">
        <div onclick="clickCancel()" class="cancel">Hủy bỏ</div>
        <a href="" class="enter">Xác nhận</a>
    </div>
  </div>
@endsection

@push("SCSS&JS")
@vite(['resources/scss/info.scss'])
<script src="{{url('js/watchTrailer.js')}}" type="text/javascript" async></script>
<script src="{{url('js/insertIMGEdit.js')}}" type="text/javascript" async></script>
<script src="{{url('js/clickAdd.js')}}" type="text/javascript" async></script>
<script src="{{url('js/clickBooking.js')}}" type="text/javascript" async></script>
@endpush