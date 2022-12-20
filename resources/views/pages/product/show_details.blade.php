@extends('layout')
@section('content')
    @foreach ($product_details as $key => $value)
        <div class="product-details">
            <!--product-details-->
            <div class="col-sm-5">
                <div class="view-product">
                    <img style="width:400px; height:400px "
                        src="{{ URL::to('public/uploads/product/' . $value->product_image) }}"
                        alt="{{ 'Ảnh của sản phẩm ' . $value->product_name }}" />
                </div>
            </div>
            <div class="col-sm-7">
                <div class="product-information">
                    <!--/product-information-->
                    <img src="{{ URL::to('public/frontend/images/new.jpg') }}" class="newarrival" alt="new" />
                    <h2>{{ $value->product_name }}</h2>
                    <p>{{ 'Mã SP: ' . $value->product_id }}</p>
                    <p>Danh mục: {{ $value->category_name }}</p>
                    <form action="/save-cart" method="POST">
                        {{ csrf_field() }}
                        <span>
                            <span>{{ number_format($value->product_price) . ' VNĐ' }}</span>
                            <label>Số lượng:</label>
                            <input type="number" name="quanty" min="1" value="1" />
                            <input type="hidden" name="productid_hidden" value="{{ $value->product_id }}" />
                        </span>
                        <button style="margin-left: 0" type="submit" class="btn btn-fefault cart">
                            <i class="fa fa-shopping-cart"></i>
                            Thêm giỏ hàng
                        </button>
                    </form>
                    <p><b>Còn hàng:</b> Có sẵn</p>
                    <p><b>Tình trạng:</b> Mới 100%</p>
                    <p><b>Thương hiệu:</b> {{ $value->brand_name }}</p>
                    <a href="#"><i class="fa fa-plus-square"></i> Thêm yêu thích</a>
                </div>
                <!--/product-information-->
            </div>
        </div>
        <div class="category-tab shop-details-tab">
            <!--category-tab-->
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#details" data-toggle="tab">Mô tả sản phẩm</a></li>
                    <li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></a></li>

                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="details">
                    <p>{!! $value->product_content !!}</p>
                </div>

                <div class="tab-pane fade" id="companyprofile">

                    <p>{!! $value->brand_desc !!}</p>
                </div>

            </div>
        </div>
    @endforeach
    <div class="recommended_items">
        <!--recommended_items-->
        <h2 class="title text-center" style="margin-top: 5px">Sản phẩm liên quan</h2>
        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">
                    @foreach ($related_product as $key => $related)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <a href="{{ URL::to('/chi-tiet-san-pham/' . $related->product_id) }}">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{ URL::to('public/uploads/product/' . $related->product_image) }}"
                                                alt="{{ ' Ảnh sản phẩm liên quan của danh mục ' . $related->category_name }}" />
                                            <h2>{{ number_format($related->product_price) . ' ₫' }}</h2>
                                            <p>{{ $related->product_name }}</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i
                                                    class="fa fa-shopping-cart"></i>Thêm
                                                giỏ hàng</a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    </div>
@endsection
