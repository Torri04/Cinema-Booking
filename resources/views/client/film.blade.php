@extends('layouts.navbar')
@php
use Carbon\Carbon;
@endphp
@section("main-content")
<section class="nav-bara">
    <a href ="{{route('film',['Film' => 'coming'])}}" class="{{Request::is('film/coming') ? 'isFilm' : ''}} film-type">PHIM SẮP CHIẾU</a>
    <a href ="{{route('film',['Film' => 'release'])}}" class="{{Request::is('film/release') ? 'isFilm' : ''}} film-type">PHIM ĐANG CHIẾU</a>
</section>
<section class="movies">
    <div class="mov-container">
      @if($film == "coming")
      @forelse($movies as $movie)
      <div class="mov">
        <a href="{{route('comingFilmInfo',["Name" => $movie->Name])}}">
          <div class="img"><img class="image" src="{{asset("storage/img/posters/".$movie->Poster)}}" alt=""></div>
          <div class="title">{{$movie->Name}}</div>
          <div class="type">Thể loại: <span class="cont">{{$movie->Genres}}</span></div>
          <div class="time">Thời lượng: <span class="cont">@php
            $date = Carbon::createFromFormat('H:i:s', $movie->Duration);
            echo $date->format('H') . 'h ' . $date->format('i') . 'm';
            @endphp</span></div>        
      </a>
      </div>
      @empty
      <h1>Không có phim nào</h1>
      @endforelse
      @else
      @forelse($movies as $movie)
      <div class="mov">
        <a class="mov" href="{{route('info',["Name" => $movie->Name,"Day" => "1stDay"])}}">
          <div class="img"><img class="image" src="{{asset("storage/img/posters/".$movie->Poster)}}" alt=""></div>
          <div class="title">{{$movie->Name}}</div>
          <div class="type">Thể loại: <span class="cont">{{$movie->Genres}}</span></div>
          <div class="time">Thời lượng: <span class="cont">@php
            $date = Carbon::createFromFormat('H:i:s', $movie->Duration);
            echo $date->format('H') . 'h ' . $date->format('i') . 'm';
            @endphp</span></div>        
      </a>
      </div>
      @empty
      <h1>Không có phim nào</h1>
      @endforelse
      @endif
  </section>
@endsection

@section("footer")
@endsection

@push("SCSS&JS")
@vite(['resources/scss/film.scss'])
@endpush
