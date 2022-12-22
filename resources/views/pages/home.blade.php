@extends('layout')
@section('content')
    <div class="features_items">
        <h2 class="title text-center" style="margin-top:5px">Tất cả sản phẩm</h2>
        @foreach ($all_product as $key => $product)
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <form>
                                {{ @csrf_field() }}
                                <input type="hidden" class="cart_product_id_{{ $product->product_id }}"
                                    value="{{ $product->product_id }}">
                                <input type="hidden" class="cart_product_name_{{ $product->product_id }}"
                                    value="{{ $product->product_name }}">
                                <input type="hidden" class="cart_product_image_{{ $product->product_id }}"
                                    value="{{ $product->product_image }}">
                                <input type="hidden" class="cart_product_price_{{ $product->product_id }}"
                                    value="{{ $product->product_price }}">
                                <input type="hidden" class="cart_product_qty_{{ $product->product_id }}" value="1">
                                <a href="{{ URL::to('/chi-tiet-san-pham/' . $product->product_id) }}">
                                    <img src="{{ URL::to('public/uploads/product/' . $product->product_image) }}"
                                        alt="{{ 'Ảnh sản phẩm ' . $product->product_name }}" />
                                    <h2>{{ number_format($product->product_price, 0, ',', '.') . ' ₫' }}</h2>
                                    <p>{{ $product->product_name }}</p>
                                    {{-- <a href="{{ URL::to('/') }}" class="btn btn-default add-to-cart"><i
                                    class="fa fa-shopping-cart"></i>Thêm giỏ
                                hàng</a> --}}
                                </a>
                                <button data-id_product="{{ $product->product_id }}" type="button"
                                    class="btn btn-default add-to-cart add-to-cart-ajax" name="add-to-card"><i
                                        class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>
                            </form>
                        </div>
                    </div>
                    <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="#"><i class="fa fa-plus-square"></i>Thêm yêu thích</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @if ($all_product)
        <div style="margin-left: 50%"> {{ $all_product->links() }}</div>
    @endif
@endsection
