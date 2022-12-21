@extends('layout')
@section('content')
    <section id="form">
        <!--form-->
        <div class="container">
            <div class="row">

                <div class="col-sm-4 col-sm-offset-1">
                    <h3>Đăng nhập </h3>
                    <div class="login-form">
                        @if (session('message'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('message') }}
                            </div>
                            {{ Session::put('message', null) }}
                        @endif
                        <form action="{{ URL::to('/login-customer') }}" method="POST">
                            {{ csrf_field() }}
                            <label for="email_account">Email</label>
                            <input type="text" placeholder="Nhập email" name="email_account" />
                            <label for="password">Mật khẩu</label>
                            <input type="password" placeholder="Nhập mật khẩu" name="password_account" />
                            <span>
                                <input type="checkbox" class="checkbox">
                                Ghi nhớ đăng nhập
                            </span>
                            <button type="submit" class="btn btn-default">Đăng nhập</button>
                        </form>
                    </div>
                    <!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h6 class="or">Hoặc</h6>
                </div>
                <div class="col-sm-4">
                    <h3>Đăng ký tài khoản mới</h3>
                    <div class="signup-form">

                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form action="{{ URL::to('/add-customer') }}" method="POST">
                            {{ csrf_field() }}
                            <label for="customer_name">Họ và tên</label>
                            <input name="customer_name" type="text" placeholder="Nhập họ và tên" required />
                            <label for="customer_email">Email</label>
                            <input name="customer_email" type="email" placeholder="Nhập Email" required />
                            <label for="customer_phone">Số điện thoại (10 số) </label>
                            <input name="customer_phone" type="text" placeholder="Nhập số điện thoại" required />
                            <label for="customer_password">Mật khẩu </label>
                            <input name="customer_password" type="password" placeholder="Nhập mật khẩu (6 - 10 ký tự)"
                                required />

                            <button type="submit" class="btn btn-default">Đăng ký</button>
                        </form>
                    </div>
                    <!--/sign up form-->
                </div>
            </div>
        </div>
    </section>
    <!--/form-->
@endsection
