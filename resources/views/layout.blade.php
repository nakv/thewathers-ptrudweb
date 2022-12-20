<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Trang chủ | The Watchers</title>
    <link href="{{ asset('public/frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/sweetalert.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head>
<!--/head-->

<body>
    <header id="header">
        <div class="header-middle">
            <!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            {{-- LOGO HERE --}}
                            <a href="/"><img style="width: 139px; height: auto;"
                                    src="{{ asset('public/frontend/images/logo.png') }}" alt="Logo" /></a>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                {{-- <li><a href="{{ URL::to('/login-checkout') }}"><i class="fa fa-user"></i> Tài khoản</a>
                                </li> --}}
                                <?php
                                $customer_id = Session::get('customer_id');
                                $shipping_id = Session::get('shipping_id');
                                if ($customer_id!=NULL && $shipping_id ==NULL) {
                                ?>
                                <li><a href="{{ URL::to('/checkout') }}"><i class="fa fa-credit-card"></i> Thanh
                                        toán</a>
                                </li>
                                <li><a href="{{ URL::to('/gio-hang') }}"><i class="fa fa-shopping-cart"></i> Giỏ
                                        hàng</a></li>
                                <li>
                                    <a href="{{ URL::to('/logout-checkout') }}">
                                        <i class="fa fa-sign-out"></i> Đăng
                                        xuất
                                    </a>
                                </li>

                                <?php } elseif($customer_id != NULL && $shipping_id != NULL){?>
                                <li><a href="{{ URL::to('/payment') }}"><i class="fa fa-credit-card"></i> Thanh
                                        toán</a>
                                </li>
                                <li><a href="{{ URL::to('/show-cart') }}"><i class="fa fa-shopping-cart"></i> Giỏ
                                        hàng</a></li>
                                <li>
                                    <a href="{{ URL::to('/logout-checkout') }}">
                                        <i class="fa fa-sign-out"></i> Đăng
                                        xuất
                                    </a>
                                </li>
                                <?php }
                                else {
                                    ?>
                                <li><a href="{{ URL::to('/login-checkout') }}"><i class="fa fa-credit-card"></i>
                                        Thanh
                                        toán</a>
                                </li>
                                <li><a href="{{ URL::to('/show-cart') }}"><i class="fa fa-shopping-cart"></i> Giỏ
                                        hàng</a></li>
                                <li>
                                <li><a href="{{ URL::to('/login-checkout') }}"><i class="fa fa-lock"></i> Đăng
                                        nhập</a>
                                </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-middle-->

        <div class="header-bottom">
            <!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{ URL::to('/trang-chu') }}" class="active">Trang chủ</a></li>
                                <li><a href="{{ URL::to('/gio-hang') }}">Giỏ hàng</a></li>
                                <li><a href="{{ URL::to('/contact-us') }}">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <form action="{{ URL::to('/tim-kiem') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="search_box pull-right">
                                <input class="search_input" type="text" name="keyword_submit"
                                    placeholder="Tìm kiếm sản phẩm" />
                                <input type="submit" style="margin-top: 0; color: white;"
                                    class="btn btn-primary btn-sm" value="Tìm kiếm" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-bottom-->
    </header>
    <!--/header-->

    <section id="slider">
        <!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">

                            <div class="item active">
                                <div class="col-sm-12">
                                    <img src="{{ asset('public/frontend/images/banner-website-1.jpg') }}"
                                        class="img-responsive2" alt="Ảnh slider" />

                                </div>
                            </div>


                            <div class="item ">

                                <div class="col-sm-12">
                                    <img style="margin-right: 50px"
                                        src="{{ asset('public/frontend/images/banner2.jpg') }}"
                                        class="img-responsive2" alt="Ảnh slider" />

                                </div>
                            </div>
                            <div class="item">

                                <div class="col-sm-12">
                                    <img style="margin-right: 50px"
                                        src="{{ asset('public/frontend/images/banner3.jpg') }}"
                                        class="img-responsive2" alt="Ảnh slider" />

                                </div>
                            </div>
                        </div>


                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--/slider-->

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Danh mục sản phẩm</h2>
                        <div class="panel-group category-products" id="accordian">
                            @foreach ($category as $key => $cate)
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><a
                                                href="{{ URL::to('/danh-muc-san-pham/' . $cate->category_id) }}">{{ $cate->category_name }}</a>
                                        </h4>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                        <!--/category-products-->

                        <div class="brands_products">
                            <!--brands_products-->
                            <h2>Thương hiệu sản phẩm</h2>
                            @foreach ($brand as $key => $brand)
                                <div class="brands-name">
                                    <ul class="nav nav-pills nav-stacked">
                                        <li><a href="{{ URL::to('/thuong-hieu-san-pham/' . $brand->brand_id) }}">
                                                <span class="pull-right">(50)</span>{{ $brand->brand_name }}</a></li>
                                    </ul>
                                </div>
                            @endforeach

                        </div>
                        <!--/brands_products-->

                        <div class="price-range">
                            <!--price-range-->
                            <h2>Mức giá</h2>
                            <div class="well text-center">
                                <input type="text" class="span2" value="" data-slider-min="0"
                                    data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]"
                                    id="sl2"><br />
                                <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-sm-9 padding-right">

                    @yield('content')


                </div>
            </div>
        </div>
    </section>

    <footer id="footer">
        <!--Footer-->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-5">

                    </div>
                    <div class="col-sm-4">
                        <div class="companyinfo">
                            <h2><span>TheWatchers</span></h2>
                            <p>Thương hiệu đồng hồ chính hãng hàng đầu Việt Nam.</p>
                        </div>
                    </div>
                    <div class="col-sm-3">

                    </div>
                </div>
            </div>
        </div>

        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="single-widget">
                            <h2>Dịch vụ</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Liên hệ</a></li>
                                <li><a href="#">CSKH</a></li>
                                <li><a href="#">Câu hỏi thường gặp</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="single-widget">
                            <h2>Chính sách</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Chính sách sử dụng</a></li>
                                <li><a href="#">Chính sách bảo mật thông tin</a></li>
                                <li><a href="#">Chính sách đổi trả</a></li>
                                <li><a href="#">Chính sách vận chuyển</a></li>
                                <li><a href="#">Chính sách bảo hành</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Giới thiệu</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Về chúng tôi</a></li>
                                <li><a href="#">Tuyển dụng</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <h2>Đăng ký nhận các thông tin mới nhất từ website</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="Điền email của bạn" />
                                <button type="submit" class="btn btn-default"><i
                                        class="fa fa-arrow-circle-o-right"></i></button>
                                <p>Chúng tôi cam kết không cung cấp email của khách hàng cho bên thứ 3.</p>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">

                <p>Copyright © 2022 TheWatchers Company. All rights reserved.</p>


            </div>
        </div>

    </footer>
    <!--/Footer-->



    <script src="{{ asset('public/frontend/js/jquery.js') }}"></script>
    <script src="{{ asset('public/frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/price-range.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('public/frontend/js/main.js') }}"></script>
    <script src="{{ asset('public/frontend/js/sweetalert.min.js') }}"></script>
    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}

    <script type="text/javascript">
        $(document).ready(function() {
            $('.add-to-cart').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: ' {{ url('/add-to-cartajax') }}',
                    method: 'POST',
                    data: {
                        cart_product_id: cart_product_id,
                        cart_product_name: cart_product_name,
                        cart_product_image: cart_product_image,
                        cart_product_price: cart_product_price,
                        cart_product_qty: cart_product_qty,
                        _token: _token
                    },

                    success: function() {
                        swal({
                                title: "Đã thêm sản phẩm vào giỏ hàng",
                                text: "Tiếp tục mua hàng hoặc vào giỏ hàng để thanh toán",
                                icon: "success",
                                buttons: {
                                    catch: {
                                        text: "Vào giỏ hàng",
                                        value: "catch",
                                    },
                                    cancel: "Xem tiếp"

                                },
                                dangerMode: false,
                            })
                            .then(function(value) {
                                if (value == "catch") {
                                    window.location = "{{ url('/gio-hang') }}";
                                }
                            })

                    }

                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.choose').on('change', function() {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var $result = '';
                if (action == "city") {
                    result = 'province';
                } else {
                    result = 'wards';
                }
                $.ajax({
                    url: ' {{ url('/select-delivery-user') }}',
                    method: 'POST',
                    data: {
                        action: action,
                        ma_id: ma_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#' + result).html(data);
                    }
                });

            });
            $('.calculate_delivery').click(function() {
                var matp = $('.city').val();
                var maqh = $('.province').val();
                var xaid = $('.wards').val();
                var _token = $('input[name="_token"]').val();
                var $result = '';
                if (matp == '' && xaid == '') {
                    alert('Chọn Tỉnh/Tp , Quận/Huyện, Xã/Thị trấn để tính phí vận chuyển!');
                } else {
                    $.ajax({
                        url: ' {{ url('/calculate-fee') }}',
                        method: 'POST',
                        data: {
                            matp: matp,
                            maqh: maqh,
                            xaid: xaid,
                            _token: _token
                        },
                        success: function() {
                            location.reload();
                        }
                    });
                }


            });
        })
    </script>
    {{-- Send Order --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('.send_order').click(function() {

                var shipping_name = $('.shipping_name').val();
                var shipping_phone = $('.shipping_phone').val();
                var shipping_email = $('.shipping_email').val();
                var addressdelivery = $('.addressdelivery').val();
                var shipping_address = $('.shipping_address').val();
                var shipping_note = $('.shipping_note').val();
                var order_fee = $('.order_fee').val();
                var payment_select = $('.payment_select').val();
                var _token = $('input[name="_token"]').val();
                if (shipping_name == '' || shipping_phone == '' || shipping_email == '' ||
                    addressdelivery == '' || shipping_address == '' || order_fee == '' || payment_select ==
                    '') {
                    alert('Vui lòng điền đầy đủ các thông tin cần thiết!');
                } else {
                    $.ajax({
                        url: ' {{ url('/confirm-order') }}',
                        method: 'POST',
                        data: {
                            shipping_name: shipping_name,
                            shipping_phone: shipping_phone,
                            shipping_email: shipping_email,
                            addressdelivery: addressdelivery,
                            shipping_address: shipping_address,
                            shipping_note: shipping_note,
                            order_fee: order_fee,
                            payment_select: payment_select,
                            _token: _token
                        },
                        success: function() {
                            alert('Đặt hàng thành công!');
                        }

                    });
                }
            });
        });
    </script>
</body>

</html>
