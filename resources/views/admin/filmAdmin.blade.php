@extends('layouts.navbar')
@php
use Carbon\Carbon;
@endphp
@section("main-content")
<section class="nav-bara">
    <a href ="{{route('adminFilm',['Film' => 'coming'])}}" class="{{Request::is('admin/film/coming') ? 'isFilm' : ''}} film-type">PHIM SẮP CHIẾU</a>
    <a href ="{{route('adminFilm',['Film' => 'release'])}}" class="{{Request::is('admin/film/release') ? 'isFilm' : ''}} film-type">PHIM ĐANG CHIẾU</a>
</section>
<section class="movies">
    <div id={{$film}} class="mov-container">
      @if($film == "coming")
      @forelse($movies as $movie)
      <div key={{$movie->MovieID}} class="mov">   
        <a href="{{route('adminComingFilmInfoEdit',["Name" => $movie->Name])}}">
           <div class="img"><img class="image" src="{{asset("storage/img/posters/".$movie->Poster)}}" alt=""></div>
           <div class="title">{{$movie->Name}}</div>
           <div class="type">Thể loại: <span class="cont">{{$movie->Genres}}</span></div>
           <div class="time">Thời lượng: <span class="cont">@php
             $date = Carbon::createFromFormat('H:i:s', $movie->Duration);
             echo $date->format('H') . 'h ' . $date->format('i') . 'm';
             @endphp</span></div>    
      </a>
      <div class="film-dele">-</div>    
      </div>
      @empty
      <h1>Không có phim nào</h1>
      @endforelse
      @else
      @forelse($movies as $movie)
      <div key={{$movie->MovieID}} class="mov">   
        <a href="{{route('adminInfoEdit',["Name" => $movie->Name,"Day" => "1stDay"])}}">
          <div class="img"><img class="image" src="{{asset("storage/img/posters/".$movie->Poster)}}" alt=""></div>
          <div class="title">{{$movie->Name}}</div>
          <div class="type">Thể loại: <span class="cont">{{$movie->Genres}}</span></div>
          <div class="time">Thời lượng: <span class="cont">@php
            $date = Carbon::createFromFormat('H:i:s', $movie->Duration);
            echo $date->format('H') . 'h ' . $date->format('i') . 'm';
            @endphp</span></div>        
      </a>
      <div class="film-dele">-</div>    
      </div>
      @empty
      <h1>Không có phim nào</h1>
      @endforelse
      @endif
      <a class="mov-edit" href="{{route('adminInfoAdd',['Film' => $film])}}">
        <div class="img"><img class="image" src="{{asset("img/plus.png")}}" alt=""></div>
      </a>
  </section>
  <form action="" method="POST" class="dele-contain" >
    @csrf
    @method("DELETE")
    <input name="mvID" id="mvID" hidden type="text">
    <input name="type" id="type" hidden type="text">
    <div class="title"></div>
    <div class="dele">
      <button class="dele-btn">Xóa</button>
      <div onclick="clickCancel()" class="cancel-btn">Hủy bỏ</div>
    </div>
  </form>

@endsection

@section("footer")
@include("layouts.footer")
@endsection

@push("SCSS&JS")
@vite(['resources/scss/film.scss'])
<script src="{{url('js/clickDelete.js')}}" type="text/javascript" async></script>
@endpush
