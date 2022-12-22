@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Tất cả đơn hàng
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>

                        <tr>
                            <th>STT</th>
                            <th>Mã đơn hàng</th>
                            <th>ID Khách </th>
                            <th>Tình trạng</th>
                            <th>Thời gian</th>
                            <th>Xem/Hủy</th>
                        </tr>

                        <?php
                        $message = Session::get('message');
                        if ($message) {
                            echo '<span class="text-alert">' . $message . '</span>';
                            Session::put('message', null);
                        }
                        $stt = 0;
                        ?>
                    </thead>
                    <tbody>

                        @foreach ($order as $key => $od)
                            <?php $stt++; ?>

                            <tr>
                                <td><a href="{{ URL::to('/view-order/' . $od->order_code) }}">{{ $stt }}</a>
                                </td>
                                <td><a href="{{ URL::to('/view-order/' . $od->order_code) }}">{{ $od->order_code }}</a>
                                </td>
                                <td>{{ $od->customer_id }}</td>
                                <td>
                                    <div>
                                        <form action="{{ URL::to('/update-order-status/' . $od->order_code) }}"
                                            method="POST">
                                            {{ csrf_field() }}
                                            <select class="select-status" name="od_status">
                                                @if ($od->order_status == 2 ||
                                                    $od->order_status == 3 ||
                                                    $od->order_status == 10 ||
                                                    $od->order_status == 11 ||
                                                    $od->order_status == 12 ||
                                                    $od->order_status == 13 ||
                                                    $od->order_status == 14)
                                                    <option <?php if ($od->order_status == 2 || $od->order_status == 3) {
                                                        echo 'selected';
                                                    } ?> value="2">Đang chờ thanh toán</option>

                                                    <option <?php if ($od->order_status == 10) {
                                                        echo 'selected';
                                                    } ?> value="10">Đã thanh toán, đang gói hàng
                                                    </option>

                                                    <option <?php if ($od->order_status == 11) {
                                                        echo 'selected';
                                                    } ?> value="11">Đang vận chuyển</option>

                                                    <option <?php if ($od->order_status == 12) {
                                                        echo 'selected';
                                                    } ?> value="12">Đã nhận hàng</option>

                                                    <option <?php if ($od->order_status == 13) {
                                                        echo 'selected';
                                                    } ?> value="13">Đã hủy đơn.</option>

                                                    <option <?php if ($od->order_status == 14) {
                                                        echo 'selected';
                                                    } ?> value="14">Đơn không hợp lệ.</option>
                                                @elseif($od->order_status == 1 ||
                                                    $od->order_status == 4 ||
                                                    $od->order_status == 5 ||
                                                    $od->order_status == 6 ||
                                                    $od->order_status == 7 ||
                                                    $od->order_status == 8)
                                                    <option <?php if ($od->order_status == 1) {
                                                        echo 'selected';
                                                    } ?> value="1">Đang chờ xác nhận</option>

                                                    <option <?php if ($od->order_status == 4) {
                                                        echo 'selected';
                                                    } ?> value="4">Đã xác nhận, đang gói hàng
                                                    </option>
                                                    <option <?php if ($od->order_status == 5) {
                                                        echo 'selected';
                                                    } ?> value="5">Đang vận chuyển</option>
                                                    <option <?php if ($od->order_status == 6) {
                                                        echo 'selected';
                                                    } ?> value="6">Đã nhận hàng</option>
                                                    <option <?php if ($od->order_status == 7) {
                                                        echo 'selected';
                                                    } ?> value="7">Đã hủy đơn</option>
                                                    <option <?php if ($od->order_status == 8) {
                                                        echo 'selected';
                                                    } ?> value="8">Đã không hợp lệ</option>
                                                @endif
                                            </select>

                                            <input style="width: 70px" style="padding: 3px" type="submit" value="Cập nhật"
                                                name="update_status" class="btn btn-default btn-sm update_status" />
                                        </form>
                                    </div>
                                </td>
                                <td>{{ date('H:i:s d-m-Y', strtotime($od->created_at)) }}</td>
                                <td>
                                    <div class="edit-delete-button">
                                        <a href="{{ URL::to('/view-order/' . $od->order_code) }}"
                                            class="active styling-edit " class="edit-admin-button" ui-toggle-class="">
                                            <i class="fa fa-pencil-square-o text-info text-active">
                                            </i>
                                        </a>
                                        <a class="delete-admin-button"
                                            onclick="return confirm('Bạn có chắc muốn xóa đơn hàng này?')"
                                            href="{{ URL::to('/delete-order/' . $od->order_code) }}"><i
                                                class="fa fa-times text-danger text styling-edit"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-sm-5 text-center">

                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination pagination-sm m-t-none m-b-none">
                            {{ $order->links() }}
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection
