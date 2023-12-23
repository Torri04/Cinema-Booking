@extends('layouts.navbar')

@section("main-content")
<form action="" method="POST"  enctype="multipart/form-data" class="promotion">
  @csrf
  @method("POST")
  <input type="text" name="promID" hidden value="{{$prom[0]->PromotionID}}">
  <div class="frame">
    <div class="hav-del">
      <div class="delete">Xóa</div>
    </div>
    <input type="text" id="title" name="title" class='title unable' value="{{$prom[0]->Title}}">
    <label for="insertIMG" style="background: var(--2st-color); cursor: pointer" class="film-info img ins unable">
      <img class="imgs" src="{{asset("storage/img/proms/" . $prom[0]->Background)}}">
      <input id="insertIMG" class="ins-ipt" name="insertIMG" type="file" accept="image/*" hidden>
  </label>    
  <div class="rule">THỂ LỆ CHƯƠNG TRÌNH</div>
    <textarea oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' id="rule_cont" class="txtare" disabled name="rule_cont">{{$prom[0]->Content}}</textarea>
    <div class="edit-row">
      <div onclick="clickEdit(this)" class="edit-btn">Chỉnh sửa</div>
      <a href="" class="cancle">Hủy bỏ</a>
      <button class="save">Lưu</button>
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
  <input type="text" name="promID" hidden value="{{$prom[0]->PromotionID}}">
  <div class="title">Bạn có chắc muốn xóa chương trình này không?</div>
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
@vite(['resources/scss/promotion.scss'])
<script src="{{url('js/insertIMGEdit.js')}}" type="text/javascript" async></script>
<script src="{{url('js/clickAddPro.js')}}" type="text/javascript" async></script>
<script src="{{url('js/clickDelePro.js')}}" type="text/javascript" async></script>
<script src="{{url('js/clickSlide.js')}}" type="text/javascript" async></script>
@endpush