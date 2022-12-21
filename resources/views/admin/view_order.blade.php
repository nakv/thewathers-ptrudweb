@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div style="text-align: center" class="panel">
            <h2 style="margin: auto">KHÁCH HÀNG</h2>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                Thông tin khách hàng đặt đơn
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>Tên KH:</th>
                            <th>ID:</th>
                            <th>SĐT:</th>
                            <th>Email:</th>
                        </tr>

                    </thead>
                    <tbody>

                        <tr>
                            <td>{{ $customer->customer_name }}</td>
                            <td>{{ $customer->customer_id }}</td>
                            <td>{{ $customer->customer_phone }}</td>
                            <td>{{ $customer->customer_email }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Thông tin vận chuyển
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>Tên người nhận: </th>
                            <th>Địa chỉ: </th>
                            <th>SĐT: </th>
                            <th>Email: </th>
                            <th>Thanh toán: </th>
                            <th>Ghi chú: </th>
                        </tr>

                    </thead>
                    <tbody>

                        <tr>
                            <td>{{ $shipping->shipping_name }}</td>
                            <td>{{ $shipping->shipping_address . ', ' . $shipping->addressdelivery }}</td>
                            <td>{{ $shipping->shipping_phone }}</td>
                            <td>{{ $shipping->shipping_email }}</td>
                            <td><?php
                            if ($shipping->payment_method == 1) {
                                echo 'COD';
                            } elseif ($shipping->payment_method == 2) {
                                echo 'BANK';
                            } else {
                                echo 'CREDIT';
                            } ?></td>
                            <td>{{ $shipping->shipping_note }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="table-agile-info">
        <div style="text-align: center" class="panel">
            <h2 style="margin: auto"> Chi tiết đơn hàng</h2>
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
                            <th nowrap>Cập nhật/Xóa: </th>
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
                                <td>
                                    <p>{{ $pro->product_name }}</p>
                                </td>
                                <td>{{ $pro->product_sales_quantity }}</td>
                                <td>{{ number_format($pro->product_price, 0, ',', '.') . 'đ' }}</td>
                                <td>{{ number_format($subtotal, 0, ',', '.') }}
                                </td>
                                <td>
                                    <div class="edit-delete-button">
                                        <a href="" class="active styling-edit " class="edit-admin-button"
                                            ui-toggle-class="">
                                            <i class="fa fa-pencil-square-o text-info text-active">
                                            </i>
                                        </a>
                                        <a class="delete-admin-button"
                                            onclick="return confirm('Bạn có chắc muốn xóa đơn hàng này?')" href=""><i
                                                class="fa fa-times text-danger text styling-edit"></i>
                                        </a>
                                    </div>
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
                        <tr>
                            <td colspan="2">
                                <h4>Tình trạng: </h4>
                            </td>

                            <td nowrap>

                                <?php
                                switch ($order[0]->order_status) {
                                    case 1:
                                        echo '<h4>Đang chờ xác nhận</h4>';
                                        break;
                                    case 2:
                                        echo '<h4>Đang chờ thanh toán</h4>';
                                        break;
                                    case 3:
                                        echo '<h4>Đang chờ thanh toán</h4>';
                                        break;
                                    case 4:
                                        echo '<h4>Đã xác nhận, đang gói hàng</h4>';
                                        break;
                                    case 5:
                                        echo '<h4>Đã thanh toán, đang gói hàng</h4>';
                                        break;
                                    case 6:
                                        echo '<h4>Đang vận chuyển</h4>';
                                        break;
                                    case 7:
                                        echo '<h4>Đã giao hàng</h4>';
                                        break;
                                    default:
                                        echo 'Lỗi tình trạng';
                                }
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
