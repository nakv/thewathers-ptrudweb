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
                                <td><a href="{{ URL::to('/my-order-detail/' . $od->order_code) }}">{{ $stt }}</a>
                                </td>
                                <td><a href="{{ URL::to('/my-order-detail/' . $od->order_code) }}">{{ $od->order_code }}</a>
                                </td>
                                <td>{{ $od->customer_id }}</td>
                                <td>{{ $od->order_status }}</td>
                                <td>{{ date('H:i:s d-m-Y', strtotime($od->created_at)) }}</td>
                                <td>
                                    <div class="edit-delete-button">
                                        <a href="{{ URL::to('/view-order/' . $od->order_code) }}" class="active styling-edit "
                                            class="edit-admin-button" ui-toggle-class="">
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
        </div>
    </div>
@endsection
