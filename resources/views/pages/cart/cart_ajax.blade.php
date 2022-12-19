@extends('layout')
@section('content')
    <section id="cart_items">
        <div>
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ URL::to('/') }}">Trang chủ</a></li>
                    <li class="active">Giỏ hàng</li>
                </ol>
            </div>

            <?php
            $message = Session::get('message');
            if ($message) {
                echo '<h3 class="text-alert-delete">' . $message . '</h3>';
                Session::put('message', null);
            }
            ?>

            <div class="table-responsive cart_info">
                <form action="{{ url('/update-cart') }}" method="POST">
                    {{ csrf_field() }}
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
                                <th style="white-space:nowrap" class="image">Ảnh sản phẩm</th>
                                <th class="description">Tên sản phẩm</th>
                                <th class="price">Đơn giá</th>
                                <th class="quantity">Số lượng</th>
                                <th class="total">Thành tiền</th>
                                <th class="price">Hủy</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            $vat = 0;
                            ?>
                            @if (Session::get('cart') == true)
                                @foreach (Session::get('cart') as $key => $cart)
                                    <?php
                                    $subtotal = $cart['product_qty'] * $cart['product_price'];
                                    $total += $subtotal;
                                    $vat = $total * 0.1;
                                    ?>
                                    <tr>
                                        <td class="image">
                                            <a href="{{ '/chi-tiet-san-pham/' . $cart['product_id'] }}"><img
                                                    src="{{ asset('/public/uploads/product/' . $cart['product_image']) }}"
                                                    alt="{{ 'ảnh sản phẩm ' . $cart['product_name'] }}" width="80px"></a>
                                        </td>
                                        <td class="cart_description">
                                            <h6> <a href="{{ '/chi-tiet-san-pham/' . $cart['product_id'] }}">
                                                    {{ $cart['product_name'] }}
                                                </a>
                                            </h6>
                                        </td>
                                        <td nowrap class="cart_price">
                                            <p> {{ number_format($cart['product_price'], 0, ',', '.') . '₫' }}</p>
                                        </td>
                                        <td class="cart_quantity">
                                            <div class="cart_quantity_button">

                                                <input style="width: 70px; text-align:center" class="cart_quantity_"
                                                    type="number" name="cart_qty[{{ $cart['session_id'] }}]"
                                                    value="{{ $cart['product_qty'] }}" min="1">


                                            </div>
                                        </td>
                                        <td nowrap class="cart_total">
                                            <p style="font-size: 20px" class="cart_total_price">
                                                {{ number_format($subtotal, 0, ',', '.') . '₫' }}</p>
                                        </td>
                                        <td class="cart_delete">
                                            <a class="cart_quantity_delete"
                                                href="{{ url('/delete-product-cart/' . $cart['session_id']) }}"><i
                                                    class="fa fa-times"></i></a>
                                        </td>
                                        <td></td>
                                    </tr>
                                @endforeach
                                <tr>

                                    <td> <button style="width: 70px" style="padding: 3px" type="submit" value="Cập nhật"
                                            name="update_qty" class="btn btn-default btn-sm check_out">Cập
                                            nhật</button></td>
                                </tr>
                                <tr>
                                    <td colspan="1"></td>
                                    <td colspan="5">
                                        <div class="col-sm-12">
                                            <div class="total_area">
                                                <ul>
                                                    <li>Tạm tính
                                                        <span>{{ number_format($total, 0, ',', '.') . ' VNĐ' }}</span>
                                                    </li>
                                                    <li>Thuế (10%):
                                                        <span>{{ number_format($vat, 0, ',', '.') . ' VNĐ' }}</span>
                                                    </li>
                                                    <li>Tổng tiền (Chưa tính phí vận chuyển):
                                                        <span>{{ number_format($vat + $total, 0, ',', '.') . ' VNĐ' }}</span>
                                                    </li>
                                                </ul>

                                                @if (Session::get('customer_id'))
                                                    <a style="margin-left: 88%" class="btn btn-default check_out"
                                                        href="{{ URL::to('/checkout') }}">
                                                        Đặt hàng</a>
                                                @else
                                                    <a style="margin-left: 88%" class="btn btn-default check_out"
                                                        href="{{ URL::to('/login-checkout') }}">
                                                        Đặt hàng</a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @else
                                @php
                                    echo ' <tr><td colspan="6"><h2 style="color:black;text-align: center">Bạn đang không có bất kì sản phẩm nào</h2></td></tr>';
                                @endphp
                            @endif
                        </tbody>

                </form>

                </table>

            </div>

        </div>

    </section>

@endsection
