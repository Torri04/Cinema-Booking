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
            <span>WATCH TRAILER</span>
        </div>
    <div class="noti">
        <div class="back"></div>
        <div class="front">Hiện chưa có lịch chiếu cho phim này</div>
    </div>
    </div>
</form>
<div onclick="closeClick()" class="overlay"></div>
<div class="frame">
    <iframe width="560" height="315" src="{{$movie[0]->Link}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    <span onclick="closeClick()" class="spn" class="spn">&times;</span>
</div>
@endsection

@push("SCSS&JS")
@vite(['resources/scss/info.scss'])
<script src="{{url('js/watchTrailer.js')}}" type="text/javascript" async></script>
@endpush
