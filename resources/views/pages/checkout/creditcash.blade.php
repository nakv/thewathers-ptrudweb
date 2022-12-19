@extends('layout')
@section('content')
    <section class="cart-items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ URL::to('/') }}">Trang chủ</a></li>
                    <li><a href="{{ URL::to('/show-cart') }}">Giỏ hàng</a></li>
                    <li><a href="{{ URL::to('/payment') }}">Thanh toán đơn hàng</a></li>
                    <li class="active">Đơn hàng đang chờ xử lý</li>
                </ol>
            </div>
            <h1>THÔNG TIN THẺ TÍN DỤNG</h1>
            <form action="">
                <div>
                    <label for="user_name">Tên chủ thẻ</label>
                    <input type="text" name="user_name" placeholder="Họ và tên">
                </div>
                <div> <label for="card_id">Mã thẻ</label>
                    <input type="text" name="card_id" placeholder="Nhập mã thẻ">
                </div>

                <div>
                    <label for="cv_code">Mã CV</label>
                    <input type="text" name="cv_code" placeholder="CV">
                </div>
                <div>
                    <label for="date_st">Ngày mở thẻ</label>
                    <input type="date" name="date_st" placeholder="Ngày mở thẻ">
                    <label for="date_ex">Ngày hết hạn</label>
                    <input type="date" name="date_ex" placeholder="Ngày hết hạn">
                </div>

            </form>
            <h4>Mọi phản hồi xin liên hệ hotline CSKH: 19000000</h4>
        </div>
    </section>
@endsection
