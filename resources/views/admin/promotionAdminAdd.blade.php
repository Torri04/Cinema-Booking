@extends('layouts.navbar')

@section("main-content")
<form action="" method="POST" enctype="multipart/form-data" class="promotion">
    @csrf
    @method("POST")
  <div class="frame">
    <input type="text" id="title" name="title" class='title'>
    <label for="insertIMG" style="background: var(--2st-color); cursor: pointer" class="film-info img ins">
      <img class="imgs">
      <input id="insertIMG" class="ins-ipt" name="insertIMG" type="file" accept="image/*" hidden>
      <div class="rdl">
        <img class="rdl-img" src="{{asset('img/cloud.png')}}">
        <div >Kéo và thả ảnh hoặc</div>
        <div >Bấm vào để thêm ảnh</div>
    </div>
  </label>    
  <div class="rule">THỂ LỆ CHƯƠNG TRÌNH</div>
    <textarea oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' id="rule_cont" class="txtare" name="rule_cont"></textarea>
    <div class="edit-row">
      <button class="edit-btn">Thêm</button>
  </div>
  </div>
</form>
<div class="annouce">
  <div class="cont">TIN TỨC KHÁC</div>
</div>
<section class="slides-show">
    <div class="slides-s">
      <img class="clickL" src="{{asset("img/icons/left.svg")}}">
      <img class="clickR" src="{{asset("img/icons/right.svg")}}">
      <div class="contain">
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
@endsection

@section("footer")
@include("layouts.footer")
@endsection

@push("SCSS&JS")
@vite(['resources/scss/promotion.scss'])
<script src="{{url('js/insertIMG.js')}}" type="text/javascript" async></script>
<script src="{{url('js/clickSlide.js')}}" type="text/javascript" async></script>
@endpush