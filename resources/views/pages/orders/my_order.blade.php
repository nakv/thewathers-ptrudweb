@extends('layout')
@section('content')
    <section id="cart_items">
        <div class="row">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ URL::to('/') }}">Trang chủ</a></li>
                    <li class="active">Đơn hàng</li>
                </ol>
            </div>
            <div class="panel-heading">
                <h2 style="text-align: center">Đơn hàng của tôi</h2>
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>

                        <tr>
                            <th>STT</th>
                            <th>Mã đơn hàng</th>
                            <th>Tình trạng</th>
                            <th>Ngày đặt</th>
                            <th>Mua lại</th>
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

                                <td> <a href="{{ URL::to('/my-order-detail/' . $od->order_code) }}">{{ $stt }} </a>

                                </td>
                                <td><a href="{{ URL::to('/my-order-detail/' . $od->order_code) }}">{{ $od->order_code }}</a>
                                </td>

                                {{-- Order Status --}}
                                <td>
                                    <?php
                                    switch ($od->order_status) {
                                        case 1:
                                            echo '<a href="' . url::to('/my-order-detail/' . $od->order_code) . '">Đang chờ xác nhận</a>';
                                            break;
                                        case 2:
                                        case 3:
                                            echo '<a href="' . url::to('/payment') . '">Đang chờ thanh toán</a>';
                                            break;
                                        case 4:
                                            echo '<a href="' . url::to('/my-order-detail/' . $od->order_code) . '">Đã xác nhận, đang gói hàng</a>';
                                            break;
                                        case 10:
                                            echo '<a href="' . url::to('/my-order-detail/' . $od->order_code) . '">Đã thanh toán, đang gói hàng</a>';
                                            break;
                                        case 5:
                                        case 11:
                                            echo '<a href="' . url::to('/my-order-detail/' . $od->order_code) . '">Đang vận chuyển</a>';
                                            break;
                                        case 6:
                                        case 12:
                                            echo '<a href="' . url::to('/my-order-detail/' . $od->order_code) . '">Đã nhận hàng</a>';
                                            break;
                                        case 7:
                                        case 13:
                                            echo '<a href="' . url::to('/my-order-detail/' . $od->order_code) . '">Đã hủy đơn</a>';
                                            break;
                                        case 8:
                                        case 14:
                                            echo '<a href="' . url::to('/my-order-detail/' . $od->order_code) . '">Đơn không hợp lệ</a>';
                                            break;
                                        default:
                                            echo 'Lỗi tình trạng';
                                    }
                                    ?>
                                </td>
                                <td>{{ date('H:i:s d-m-Y', strtotime($od->created_at)) }}</td>

                                <td>

                                    <a href="{{ URL::to('#') }}">
                                        <i class="fa fa-refresh"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!--/#cart_items-->
@endsection
