@extends('layouts.navbar')

@section("main-content")
<section class="member-ctn">
    <div class="nav-info">
        <a href={{route("userAccount")}} class="{{Request::is('user/account') ? 'isMember' : ''}} opt-info">THÔNG TIN TÀI KHOẢN</a>
        <a href={{route("userMember")}} class="{{Request::is('user/member') ? 'isMember' : ''}} opt-info">THẺ THÀNH VIÊN</a>
        <a href={{route("userHistory")}} class="{{Request::is('user/history') ? 'isMember' : ''}} opt-info">LỊCH SỬ ĐẶT VÉ</a>
    </div>
    <div class="mem-info">
        <table class="table">
            <tr>
                <td style="width: 23%" class="til">SỐ THẺ</td>
                <td  style="width: 23%" class="til">HẠNG THẺ</td>
                <td style="width: 18%" class="til">NGÀY KÍCH HOẠT</td>
                <td  style="width: 18%" class="til">TỔNG CHI TIÊU</td>
                <td  style="width: 18%"class="til">ĐIỂM TÍCH LŨY</td>
            </tr>
            <tr style="height: 70px">
                <td>{{$user[0]->UserID}}</td> 
                <td>{{$user[0]->MbsLevel}}</td>
                <td>
                    @php
                    use Carbon\Carbon;
                    $date = Carbon::createFromFormat('Y-m-d', $user[0]->CreatedDay);
                    echo $date->format('d/m/Y');
                    @endphp
                </td>
                <td>{{number_format($user[0]->Expense)}}</td>
                <td>{{$user[0]->Point}}</td>
            </tr>
        </table>
        @if($user[0]->MbsLevel=="Standard")
        <div class="noted">Bạn cần tích lũy thêm: <span class="money-required">{{number_format(2000000-$user[0]->Expense)}}</span> vnđ để nâng hạng khách hàng <span class="member-type">VIP</span></div>
        @elseif($user[0]->MbsLevel=="VIP")
        <div class="noted">Bạn cần tích lũy thêm: <span class="money-required">{{number_format(7000000-$user[0]->Expense)}}</span> vnđ để nâng hạng khách hàng <span class="member-type">V.VIP</span></div>
        @else
        <div class="noted">Thẻ của bạn đang ở hạng cao nhất</div>
        @endif
    </div>
</section>
@endsection

@push("SCSS&JS")
@vite(['resources/scss/member.scss'])
@endpush
