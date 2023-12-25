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
          <img src="{{asset("storage/img/movies/".$movies[5]->Background)}}" class="d-block img" alt="...">
        </div>
        <div class="carousel-item">
        <img src="{{asset("storage/img/movies/".$movies[1]->Background)}}" class="d-block img" alt="...">
        </div>
        <div class="carousel-item">
        <img src="{{asset("storage/img/movies/".$movies[4]->Background)}}" class="d-block img" alt="...">
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
    <div class="book">
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
         <a href="" class="btn a-href" >Đặt vé ngay</a>
       </div>
    </div>
    <section class="movies">
      <div class="mov-container">
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
        <button class="film-dele">-</button>    
        </div>
        @empty
        <h1>Không có phim nào</h1>
        @endforelse
        <a class="mov-edit" href="{{route('adminInfoAdd',["Film"=>"release"])}}">
          <div class="img"><img class="image" src="{{asset("img/plus.png")}}" alt=""></div>
        </a>
    </section>
    <section class="promo">
      <div class="title">CHƯƠNG TRÌNH ƯU ĐÃI - SỰ KIỆN</div>
    </section>
    <section class="slides-show">
      <div class="slides-s">
        <img class="clickL" src="{{asset("img/icons/left.svg")}}">
        <img class="clickR" src="{{asset("img/icons/right.svg")}}">
        <div class="contain">
          <a href="{{route('addPromotion')}}" class="each">
            <div class="add-prom">
              <img src="{{asset("/img/plus.png")}}">
            </div>
          </a>
          @forelse($otherProm as $prome)
          <a href="{{route('adminPromotion',['PromotionID' => $prome->PromotionID])}}" class="each">
            <img src="{{asset("storage/img/proms/" . $prome->Background)}}">
            <div class="title">{{$prome->Title}}</div>
          </a>
          @empty
          @endforelse
        </div>
      </div>
  </section>
    <form action="" method="POST" class="dele-contain" >
      @csrf
      @method("DELETE")
      <input name="mvID" id="mvID" hidden type="text">
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
@vite(['resources/scss/home.scss'])
<script src="{{url('js/selectTime.js')}}" type="text/javascript" async></script>
<script src="{{url('js/clickDelete.js')}}" type="text/javascript" async></script>
<script src="{{url('js/clickSlide.js')}}" type="text/javascript" async></script>
@endpush
