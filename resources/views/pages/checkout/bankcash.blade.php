@extends('layout')
@section('content')
    <section class="cart-items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ URL::to('/') }}">Trang chủ</a></li>
                    <li><a href="{{ URL::to('/show-cart') }}">Giỏ hàng</a></li>
                    <li><a href="{{ URL::to('/payment') }}">Thanh toán đơn hàng</a></li>
                    <li class="active">Thanh toán chuyển khoản</li>
                </ol>
            </div>
            <h1>THÔNG TIN CHUYỂN KHOẢN</h1>
            <h3>Tên người thụ hưởng: </h3>
            <p>NGUYỄN ANH KHOA</p>
            <h3>Ngân hàng: </h3>
            <p>BIDV CN Tp HCM</p>
            <h3>Số tài khoản: </h3>
            <p>72110001228165</p>
            <h4>LƯU Ý: Nội dung chuyển khoản gồm: SĐT - Mã đơn hàng</h4>
            <h4>Mọi phản hồi xin liên hệ hotline CSKH: 19000000</h4>
        </div>
    </section>
@endsection
