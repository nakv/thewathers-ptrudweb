@extends('layout')
@section('content')
    <section id="cart_items">
        <div class="row">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ URL::to('/') }}">Trang chủ</a></li>
                    <li><a href="{{ URL::to('/my-order') }}">Đơn hàng</a></li>
                    <li class="active">Chi tiết đơn hàng</li>
                </ol>
            </div>
            <div class="panel-heading">
                <h2 style="text-align: center">{{ ' Đơn hàng: ' . $order->order_code }}</h2>
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>

                        <tr>

                            <th>Tình trạng</th>
                            <th>Hình thức thanh toán</th>
                            <th>Thời gian</th>

                        </tr>

                        <?php
                        $message = Session::get('message');
                        if ($message) {
                            echo '<span class="text-alert">' . $message . '</span>';
                            Session::put('message', null);
                        }
                        ?>
                    </thead>
                    <tbody>
                        <tr>

                            <td>{{ $order->order_status }}</td>
                            <td><?php
                            if ($shipping->payment_method == 1) {
                                echo 'Thanh toán khi nhận hàng (COD)';
                            } elseif ($shipping->payment_method == 2) {
                                echo 'Chuyển khoản ngân hàng';
                            } else {
                                echo 'Thanh toán thẻ tín dụng';
                            } ?></td>
                            <td>{{ date('H:i:s d-m-Y', strtotime($order->created_at)) }}</td>
                        </tr>
                        <tr>

                        </tr>

                    </tbody>
                </table>

                <div class="table-agile-info">
                    <div style="text-align: center" class="panel">
                        <h3 style="margin: auto">Thông tin người nhận</h3>
                    </div>
                    <div class="panel panel-default">

                        <div class="table-responsive">
                            <table class="table table-striped b-t b-light">
                                <thead>
                                    <tr>
                                        <th>Tên người nhận: </th>
                                        <th>Địa chỉ: </th>
                                        <th>SĐT: </th>
                                        <th>Ghi chú: </th>
                                    </tr>

                                </thead>
                                <tbody>

                                    <tr>
                                        <td>{{ $shipping->shipping_name }}</td>
                                        <td>{{ $shipping->shipping_address . ', ' . $shipping->addressdelivery }}</td>
                                        <td>{{ $shipping->shipping_phone }}</td>

                                        <td>{{ $shipping->shipping_note }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="table-agile-info">
                    <div style="text-align: center" class="panel">
                        <h3 style="margin: auto"> Chi tiết đơn hàng</h3>
                    </div>
                    <div class="panel panel-default">
                        {{-- <div class="panel-heading">

                        </div> --}}
                        <div class="table-responsive">
                            <table class="table table-striped b-t b-light">
                                <thead>
                                    <tr>

                                        <th nowrap>STT: </th>
                                        <th>Tên sản phẩm: </th>
                                        <th>Số lượng: </th>
                                        <th>Đơn giá: </th>
                                        <th nowrap>Thành tiền: </th>
                                    </tr>
                                    <?php
                                    $message = Session::get('message');
                                    if ($message) {
                                        echo '<span class="text-alert">' . $message . '</span>';
                                        Session::put('message', null);
                                    }
                                    ?>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    $subtotal = 0;
                                    $vat = 0;
                                    $total = 0;
                                    $allcount = 0;
                                    
                                    ?>
                                    @foreach ($od_details as $key => $pro)
                                        <?php
                                        $feeship = $pro->order_feeship;
                                        $i++;
                                        $subtotal = $pro->product_price * $pro->product_sales_quantity;
                                        $total += $subtotal;
                                        $vat += 0.1 * $total;
                                        $allcount = $total + $vat + $feeship;
                                        ?>
                                        <tr>
                                            <td>{{ $i }}</td>
                                            </td>
                                            <td>
                                                <p>{{ $pro->product_name }}</p>
                                            </td>
                                            <td>{{ $pro->product_sales_quantity }}</td>
                                            <td>{{ number_format($pro->product_price, 0, ',', '.') . 'đ' }}</td>
                                            <td>{{ number_format($subtotal, 0, ',', '.') }}
                                            </td>

                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="2">
                                            <h4>Tạm tính: </h4>
                                        </td>

                                        <td>
                                            <h4>
                                                {{ number_format($total) . 'đ' }}</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <h4>Thuế: </h4>
                                        </td>

                                        <td>
                                            <h4>
                                                {{ number_format($vat) . 'đ' }}</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <h4>Phí vận chuyển: </h4>
                                        </td>

                                        <td>
                                            <h4>
                                                {{ number_format($feeship) . 'đ' }}</h4>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">
                                            <h4>Tổng cộng: </h4>
                                        </td>

                                        <td>
                                            <h4>
                                                {{ number_format($allcount) . 'đ' }}</h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--/#cart_items-->
@endsection
