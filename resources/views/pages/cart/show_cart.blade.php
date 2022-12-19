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
        </div>
    </section>
    <section id="do_action">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="total_area">
                        <ul>
                            <li>Tổng <span>{{ Cart::priceTotal(0, ',', '.') . ' VNĐ' }}</span></li>
                            <li>Thuế (10%)<span>{{ Cart::tax(0, ',', '.') . ' VNĐ' }}</span></li>
                            <li>Phí vận chuyển <span>Free</span></li>
                            <li>Thành tiền <span>{{ Cart::total(0, ',', '.') . ' VNĐ' }}</span></li>
                        </ul>
                        <?php
                                $customer_id = Session::get('customer_id');
                                $shipping_id = Session::get('shipping_id');
                                if ($customer_id!=NULL && $shipping_id ==NULL) {
                                ?>
                        <a class="btn btn-default check_out" href="{{ URL::to('/checkout') }}"> Thanh
                            toán</a>
                        <?php } elseif($customer_id!=NULL && $shipping_id != NULL){?>
                        <a class="btn btn-default check_out" href="{{ URL::to('/payment') }}"> Thanh toán</a>
                        <?php }else{?>
                        <a class="btn btn-default check_out" href="{{ URL::to('/login-checkout') }}"> Thanh toán</a>
                        <?php
                            }
                            ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
