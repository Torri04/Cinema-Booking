@extends('layouts.navbar')
@php
use Carbon\Carbon;
@endphp
@section("main-content")
<section class="body">
    <div  id="carouselExampleIndicators" class="carousel slide slides" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active btn" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2" class="btn"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3" class="btn"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="{{asset("storage/img/movies/".$movies[0]->Background)}}" class="d-block img" alt="...">
        </div>
        <div class="carousel-item">
        <img src="{{asset("storage/img/movies/".$movies[1]->Background)}}" class="d-block img" alt="...">
        </div>
        <div class="carousel-item">
        <img src="{{asset("storage/img/movies/".$movies[2]->Background)}}" class="d-block img" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    </section>
    <form action="" method="POST" class="book">
      @csrf
      @method("POST")
         <div class="remain quickbook">QUICK BOOK</div>
         <nav class="booking">
         <select class="slc selectpicker film" name="film" aria-label="Default select example">
           <option class="opt" selected>Chọn phim</option>
           @forelse($movies as $movie)
           <option class="opt" value="{{$movie->MovieID}}">{{$movie->Name}}</option>
           @empty
           @endforelse
         </select>
         <select class="slc selectpicker date" name="date" aria-label="Default select example">
           <option class="opt" selected>Ngày chiếu</option>
           <option class="opt" value=@php
           $date = Carbon::now();
           echo $date->format('Y-m-d'); @endphp>
           @php
            $date = Carbon::now();
            echo $date->format('d/m/Y');
           @endphp
           </option>
           <option class="opt" value=@php
           $date = Carbon::now()->addDay(1);
           echo $date->format('Y-m-d'); @endphp>
           @php
            $date = Carbon::now()->addDay(1);
            echo $date->format('d/m/Y');
           @endphp</option>
           <option class="opt" value=@php
           $date = Carbon::now()->addDay(2);
           echo $date->format('Y-m-d'); @endphp>
           @php
            $date = Carbon::now()->addDay(2);
            echo $date->format('d/m/Y');
           @endphp</option>
         </select>
         <select class="slc selectpicker timer" name="time" aria-label="Default select example">
           <option class="opt" selected>Giờ chiếu</option>
         </select>
         </nav>
          <div class="remain">
            <input class="btn" type="button" name="booking" value="Đặt vé ngay">
          </div>
    </form>
    <section class="movies">
      <div class="mov-container">
        @forelse($movies as $movie)
        <div class="mov">
          <a href="{{route('info',["Name" => $movie->Name,"Day" => "1stDay"])}}">
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
    </section>
    <section class="promo">
      <div class="title">CHƯƠNG TRÌNH ƯU ĐÃI</div>
    </section>
    @php
    $json = json_encode($shows);
    echo "
    <script>var data = $json;</script>";
    @endphp
@endsection


@section("footer")
@include("layouts.footer")
@endsection

@push("SCSS&JS")
@vite(['resources/scss/home.scss'])
<script src="{{url('js/selectTime.js')}}" type="text/javascript" async></script>
@endpush
