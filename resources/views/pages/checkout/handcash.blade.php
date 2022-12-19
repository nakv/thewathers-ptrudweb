@extends('layout')
@section('content')
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('/') }}">Trang chủ</a></li>
                <li><a href="{{ URL::to('/show-cart') }}">Giỏ hàng</a></li>
                <li><a href="{{ URL::to('/payment') }}">Thanh toán đơn hàng</a></li>
                <li class="active">Đơn hàng đang chờ xử lý</li>
            </ol>
        </div>
        <h3>Cảm ơn bạn đã mua hàng tại website!</h3>
        <h4>Đơn hàng của bạn đang được xử lý.</h4>
        <h4>Mọi phản hồi xin liên hệ hotline CSKH: 19000000</h4>
    </div>
@endsection
