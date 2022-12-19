@extends('layout')
@section('content')
    <section id="cart_items">
        <div>
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ URL::to('/') }}">Trang chủ</a></li>
                    <li><a href="{{ URL::to('/show-cart') }}">Giỏ hàng</a></li>
                    <li class="active">Thanh toán đơn hàng</li>
                </ol>
            </div>
            <div class="review-payment">
                <h2>Xem lại giỏ hàng</h2>
            </div>
            <div class="table-responsive cart_info">
                <?php
                $content = Cart::content();
                
                ?>
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <th style="white-space:nowrap" class="image">Hình ảnh sản phẩm</th>
                            <th class="description">Tên sản phẩm</th>
                            <th class="price">Đơn giá</th>
                            <th class="quantity">Số lượng</th>
                            <th class="total">Tổng tiền</th>
                            <th class="price">Hủy</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($content as $v_content)
                            <tr>
                                <td class="image">
                                    <a href="{{ '/chi-tiet-san-pham/' . $v_content->id }}"><img
                                            src="{{ URL::to('/public/uploads/product/' . $v_content->options->image) }}"
                                            alt="ảnh sản phẩm" width="60px"></a>
                                </td>
                                <td class="cart_description">
                                    <h6> <a href="{{ '/chi-tiet-san-pham/' . $v_content->id }}">{{ $v_content->name }}</a>
                                    </h6>
                                </td>
                                <td nowrap class="cart_price">
                                    <p><?php echo number_format($v_content->price, 0, ',', '.') . ' &#8363;'; ?></p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <form action="{{ URL::to('/update-cart-quantity/' . $v_content->rowId) }}"
                                            method="POST">
                                            {{ csrf_field() }}
                                            <input size="3" class="cart_quantity_input" type="text"
                                                name="cart_quantity" value="{{ $v_content->qty }}">
                                            {{-- <input type="hidden" value="{{ $v_content->rowId }}" name="rowId_cart"
                                              class="form-control"> --}}
                                            <button style="padding: 3px" type="submit" value="Cập nhật" name="update_qty"
                                                class="btn btn-default btn-sm">Cập nhật</button>
                                        </form>
                                    </div>
                                </td>
                                <td nowrap class="cart_total">
                                    <p style="font-size: 20px" class="cart_total_price"><?php
                                    $subtotal = $v_content->price * $v_content->qty;
                                    echo number_format($subtotal, 0, ',', '.') . ' &#8363;';
                                    ?></p>
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete"
                                        href="{{ URL::to('/delete-to-cart/' . $v_content->rowId) }}"><i
                                            class="fa fa-times"></i></a>
                                </td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>



            <div>
                <h3>Chọn một trong các hình thức thanh toán sau</h3>
            </div>
            <div class="payment_options">
                <form action="{{ URL::to('/order-place') }}" method="POST">
                    {{ csrf_field() }}
                    <div> <input value="1" name="payment_option" type="radio" required>
                        <label for="payment_option"> Chuyển khoản ngân hàng</label>
                    </div>
                    <div>
                        <input value="2" name="payment_option" type="radio" required>
                        <label for="payment_option">Phương thức COD &#40;thanh toán khi nhận
                            hàng&#41;</label>
                    </div>
                    <div> <input value="3" name="payment_option" type="radio" required>
                        <label for="payment_option">Thanh toán thẻ tín dụng</label>
                    </div>
                    <input type="submit" value="Đặt hàng" name="send_order" class="btn btn-primary btn-sm">
                </form>
            </div>
        </div>
    </section>

    <!--/#cart_items-->
@endsection
