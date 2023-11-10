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
            <input id="Name" name="Name" class="title ipt" type="text" placeholder="Tên phim...">
            <input id="Lan" name="Lan" class="lan ipt " type="text" placeholder="Ngôn ngữ...">
            <input id="Genres" name="Genres" class="type ipt " type="text" placeholder="Thể loại...">
            <div class="date-time">
                <div class="cover">
                   <img src="{{asset('img/icons/home.svg')}}">
                   <input id="Date" name="Date" class="date ipt " type="text" placeholder="Ngày dự kiến...">
                </div>
                <div class="cover">
                   <img src="{{asset('img/icons/home.svg')}}">
                   <input id="Dur" name="Dur" class="dur ipt " type="text" placeholder="Thời lượng...">
                </div>
            </div>
            <div class="tit">Đạo diễn</div>
            <input id="Direc" name="Direc" class="tit-cnt ipt " type="text" placeholder="...">
            <div class="tit">Diễn viên chính</div>
            <textarea style="height: 55px" id="Actor" name="Actor" class="tit-cnt ipt" placeholder="..."></textarea>
            <div class="tit">Nội dung</div>
            <textarea id="Content" name="Content"  class="content ipt" placeholder="..."></textarea>
        </div>
    </div>
    <div class="right-side">
        <label for="insertIMG" style="background: var(--2st-color); cursor: pointer" class="film-info ins">
            <img class="imgs">
            <input id="insertIMG" class="ins-ipt" name="insertIMG" type="file" accept="image/*" hidden>
            <div class="rdl">
                <img class="rdl-img" src="{{asset('img/cloud.png')}}">
                <div >Kéo và thả ảnh hoặc</div>
                <div >Bấm vào để thêm ảnh</div>
            </div>
        </label>
        <label for="insertPoster" style="background: var(--2st-color); cursor: pointer" class="poster ins">
            <img class="imgs">
            <input id="insertPoster" class="ins-ipt" name="insertPoster" type="file" accept="image/*" hidden>
            <div class="rdl">
                <img class="rdl-img" src="{{asset('img/cloud.png')}}">
                <div >Kéo và thả ảnh hoặc</div>
                <div >Bấm vào để thêm ảnh</div>
            </div>
        </label>  
        <input id="trailer" name="trailer" type ="text" class="trail" placeholder="Link trailer...">
        <button class="add">Thêm phim</button>
    </div>
</section>

@endsection

@push("SCSS&JS")
@vite(['resources/scss/info.scss'])
<script src="{{url('js/insertIMG.js')}}" type="text/javascript" async></script>
@endpush