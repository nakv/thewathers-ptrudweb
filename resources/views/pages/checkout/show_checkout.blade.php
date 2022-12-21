@extends('layout')
@section('content')
    <section id="cart_items">
        <div class="row">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ URL::to('/') }}">Trang chủ</a></li>
                    <li><a href="{{ URL::to('/show-cart') }}">Giỏ hàng</a></li>
                    <li class="active">Đặt hàng</li>
                </ol>
            </div>
            <div class="shopper-informations">
                <div class="col-sm-12 clearfix">
                    <h4>Đơn hàng hiện tại của bạn</h4>
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


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total = 0;
                                    $vat = 0;
                                    $ship = 0;
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
                                                            alt="{{ 'ảnh sản phẩm ' . $cart['product_name'] }}"
                                                            width="80px"></a>
                                                </td>
                                                <td class="cart_description">
                                                    <h6> <a href="{{ '/chi-tiet-san-pham/' . $cart['product_id'] }}">
                                                            {{ $cart['product_name'] }}
                                                        </a>
                                                    </h6>
                                                </td>
                                                <td nowrap class="cart_price">
                                                    <p> {{ number_format($cart['product_price'], 0, ',', '.') . '₫' }}
                                                    </p>
                                                </td>
                                                <td class="cart_quantity">
                                                    <div class="cart_quantity_button" style="margin-bottom: 10px">
                                                        <input style="width: 70px; text-align:center" class="cart_quantity_"
                                                            type="text" name="cart_qty[{{ $cart['session_id'] }}]"
                                                            value="{{ $cart['product_qty'] }}" disabled>
                                                    </div>
                                                </td>
                                                <td nowrap class="cart_total">
                                                    <p style="font-size: 20px" class="cart_total_price">
                                                        {{ number_format($subtotal, 0, ',', '.') . '₫' }}</p>
                                                </td>

                                                <td></td>
                                            </tr>
                                        @endforeach

                                        <tr>
                                            <td colspan="1"></td>
                                            <td colspan="5">
                                                <div class="col-sm-10" style="margin-left: 132px">
                                                    <div class="total_area">
                                                        <ul>
                                                            <li>Tạm tính:
                                                                <span>{{ number_format($total, 0, ',', '.') . ' VNĐ' }}</span>
                                                            </li>
                                                            <li>Thuế (10%):
                                                                <span>{{ number_format($vat, 0, ',', '.') . ' VNĐ' }}</span>
                                                            </li>
                                                            @if (Session::get('fee'))
                                                                <?php
                                                                $ship = Session::get('fee');
                                                                ?>

                                                                <li><a class="cart_quantity_delete"
                                                                        href="{{ url('/del-fee') }}">( <i
                                                                            class="fa fa-minus"></i> )</a>Phí vận
                                                                    chuyển:
                                                                    <span>{{ number_format(Session::get('fee'), 0, ',', '.') . ' VNĐ' }}</span>
                                                                </li>
                                                            @endif
                                                            <li>Tổng tiền:
                                                                <span>{{ number_format($vat + $total + $ship, 0, ',', '.') . ' VNĐ' }}</span>
                                                            </li>
                                                        </ul>
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

                @if (Session::get('cart'))
                    <div class="col-sm-12 clearfix">
                        <h3>Thông tin vận chuyển đơn hàng</h3>
                        <div class="form-one" style="margin-right: 50px">
                            <h4 style="margin-top:20px ">Chọn địa điểm vận chuyển và tính phí vận chuyển: </h4>
                            <form>
                                @csrf
                                <div class="form-group">
                                    <label for="city">Chọn thành phố</label>
                                    <select class="form-control input-sm m-bot15 choose city" name="city" id="city"
                                        required>
                                        <option value="">-- Chọn tỉnh/thành phố --</option>
                                        @foreach ($city as $key => $ci)
                                            <option value="{{ $ci->matp }}">{{ $ci->name_city }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="province">Chọn quận huyện</label>
                                    <select class="form-control input-sm m-bot15 choose province" name="province"
                                        id="province" required>
                                        <option value="">-- Chọn quận huyện --</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="wards">Chọn xã phường</label>
                                    <select id="wards" name="wards" class="form-control input-sm m-bot15 wards"
                                        required>
                                        <option value="">-- Chọn xã phường --</option>
                                    </select>
                                </div>

                                <input style="margin-left:30% ;width: 150px; background-color:aquamarine;" type="button"
                                    value="Tính phí vận chuyển" name="calculate_order"
                                    class="btn btn-default hover-style2  calculate_delivery ">
                            </form>
                            @if (Session::get('fee'))
                                <a class="cart_quantity_delete" href="{{ url('/del-fee') }}">( <i class="fa fa-minus"></i>
                                    )</a>Phí vận
                                chuyển:
                                <span>{{ number_format(Session::get('fee'), 0, ',', '.') . ' VNĐ' }}</span>
                            @endif
                        </div>
                        <div>


                            <div class="form-one">
                                <form method="POST">
                                    {{ csrf_field() }}
                                    <label for="shipping_name">Họ và tên người nhận hàng</label>
                                    <input type="text" name="shipping_name" class="shipping_name" placeholder="Họ và tên"
                                        required>
                                    <label for="shipping_phone">Số điện thoại nhận hàng</label>
                                    <input type="text" name="shipping_phone" class="shipping_phone"
                                        placeholder="Số điện thoại" required>
                                    <label for="shipping_email">Email đặt đơn hàng</label>
                                    <input type="email" placeholder="Email" name="shipping_email" class="shipping_email"
                                        required>
                                    <label for="addressdelivery">Tỉnh/Tp, Quận/Huyện, Xã/Phường/Thị trấn</label>

                                    @if (Session::get('address_delivery'))
                                        <input type="text" name="addressdelivery" class="addressdelivery"
                                            placeholder="Chọn địa chỉ tính phí vận chuyển" disabled
                                            value="{{ Session::get('address_delivery') }}" required>
                                    @else
                                        <input type="text" name="addressdelivery" class="addressdelivery"
                                            placeholder="Chọn địa điểm để tính phí vận chuyển" disabled required>
                                    @endif
                                    <input type="hidden" name="order_fee" class="order_fee"
                                        value="{{ $ship }}">
                                    <label for="shipping_address">Địa chỉ nhận hàng chi tiết</label>
                                    <input type="text" name="shipping_address"
                                        class="shipping_address"placeholder="Ghi rõ số đường, số nhà" required>
                                    <label for="shipping_note">Ghi chú đơn hàng</label>
                                    <textarea name="shipping_note" class="shipping_note" placeholder="Ghi chú" rows="4"></textarea>
                                    <div class="form-group">
                                        <label for="payment_select">Hình thức thanh toán</label>
                                        <select name="payment_select" class="payment_select" id="" required>
                                            <option value="">-- Chọn hình thức thanh toán --</option>
                                            <option value="1">Thanh toán khi nhận hàng (COD)</option>
                                            <option value="2">Chuyển khoản ngân hàng.</option>
                                            <option value="3">Thanh toán thẻ tín dụng</option>
                                        </select>
                                    </div>
                                    <input type="button" value="Xác nhận đơn đặt hàng" name="send_order"
                                        class="btn btn-primary hover-style send_order" />
                                </form>
                            </div>



                        </div>
                    </div>
                @endif


            </div>
        </div>
        <div class="review-payment">
            <a href="{{ URL::to('/show-cart') }}">
                <h2>Xem lại giỏ hàng</h2>
            </a>

        </div>

        </div>
    </section>
    <!--/#cart_items-->
@endsection
